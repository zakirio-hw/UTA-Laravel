<?php
// app/Http/Controllers/UtaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalculationHistory;

class UtaController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function calculate(Request $request)
    {
        // Ambil data dari request
        $criteria = $request->input('nama_kriteria');
        $weights = $request->input('bobot_kriteria');
        $types = $request->input('jenis_kriteria');
        $alternatives = $request->input('nama_alternatif');
        $values = $request->input('nilai');

        // Debugging
        if (empty($criteria) || empty($weights) || empty($types) || empty($alternatives) || empty($values)) {
            return response()->json([
                'message' => 'Incomplete input data',
                'criteria' => $criteria,
                'weights' => $weights,
                'types' => $types,
                'alternatives' => $alternatives,
                'values' => $values,
            ]);
        }

        // Simpan ke database
        $history = new CalculationHistory();
        $history->criteria = json_encode($criteria);
        $history->alternatives = json_encode($alternatives);
        $history->values = json_encode($values);
        $history->weights = json_encode($weights);
        $history->types = json_encode($types);
        $history->save();

        // Perhitungan UTA Method
        $data = $this->utaCalculation($criteria, $weights, $types, $alternatives, $values);

        return view('calculate', compact('data'));
    }

    public function history()
    {
        $histories = CalculationHistory::all();
        return view('history', compact('histories'));
    }

    public function deleteHistory($id)
    {
        CalculationHistory::destroy($id);
        return redirect()->route('history');
    }

    public function recalculateHistory($id)
    {
        $history = CalculationHistory::find($id);
        $criteria = json_decode($history->criteria, true);
        $alternatives = json_decode($history->alternatives, true);
        $values = json_decode($history->values, true);
        $weights = json_decode($history->weights, true);
        $types = json_decode($history->types, true);

        // Perhitungan UTA Method
        $data = $this->utaCalculation($criteria, $weights, $types, $alternatives, $values);

        return view('calculate', compact('data'));
    }

    private function utaCalculation($criteria, $weights, $types, $alternatives, $values)
    {
        $num_criteria = count($weights);
        $num_alternatives = count($values);

        // Menampilkan Nama dan Bobot Kriteria dalam Tabel
        $criteria_data = [];
        foreach ($criteria as $key => $name) {
            $criteria_data[] = [
                'name' => $name,
                'weight' => $weights[$key],
                'type' => ucfirst($types[$key])
            ];
        }

        // Menampilkan Matriks Keputusan dalam Tabel
        $decision_matrix = [];
        foreach ($values as $alt_index => $alt_values) {
            if (isset($alternatives[$alt_index])) {
                $alternative = [
                    'name' => $alternatives[$alt_index]
                ];
                foreach ($alt_values as $crit_index => $value) {
                    $alternative['criteria'][] = $value;
                }
                $decision_matrix[] = $alternative;
            }
        }

        // Melakukan normalisasi pada nilai keputusan
        $normalized_values = [];
        for ($i = 0; $i < $num_criteria; $i++) {
            $column = array_column($values, $i);
            if (!empty($column)) {
                if ($types[$i] == 'benefit') {
                    $max_value = max($column);
                    foreach ($values as $j => $alt) {
                        $normalized_values[$j][$i] = $alt[$i] / $max_value;
                    }
                } else { // jenis kriteria adalah 'cost'
                    $min_value = min($column);
                    foreach ($values as $j => $alt) {
                        $normalized_values[$j][$i] = $min_value / $alt[$i];
                    }
                }
            }
        }

        // Mencari nilai perbedaan interval
        $intervals = [];
        for ($i = 0; $i < $num_criteria; $i++) {
            if (isset($normalized_values[0][$i])) {
                $intervals[$i] = (1 - min(array_column($normalized_values, $i))) / $weights[$i];
            }
        }

        // Menghitung nilai utilitas dan perankingan
        $utility_values = [];
        foreach ($normalized_values as $j => $alt) {
            $utility_values[$j] = 0;
            for ($i = 0; $i < $num_criteria; $i++) {
                if (isset($alt[$i]) && isset($intervals[$i])) {
                    $utility_values[$j] += $alt[$i] * $intervals[$i];
                }
            }
        }

        // Melakukan perankingan
        arsort($utility_values);
        $ranking = [];
        $rank = 1;
        foreach ($utility_values as $alt_index => $utility) {
            if (isset($alternatives[$alt_index])) {
                $ranking[] = [
                    'name' => $alternatives[$alt_index],
                    'utility' => $utility,
                    'rank' => $rank++
                ];
            }
        }

        return [
            'criteria_data' => $criteria_data,
            'decision_matrix' => $decision_matrix,
            'normalized_values' => $normalized_values,
            'intervals' => $intervals,
            'utility_values' => $utility_values,
            'ranking' => $ranking
        ];
    }
}
