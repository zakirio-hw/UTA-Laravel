<!-- resources/views/calculate.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil Perhitungan UTA Method</h2>

    <h3>Nama dan Bobot Kriteria</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Jenis Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['criteria_data'] as $criteria)
            <tr>
                <td>{{ $criteria['name'] }}</td>
                <td>{{ $criteria['weight'] }}</td>
                <td>{{ $criteria['type'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Matriks Keputusan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach($data['criteria_data'] as $criteria)
                <th>{{ $criteria['name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data['decision_matrix'] as $decision)
            <tr>
                <td>{{ $decision['name'] }}</td>
                @foreach($decision['criteria'] as $value)
                <td>{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Hasil Normalisasi</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach($data['criteria_data'] as $criteria)
                <th>{{ $criteria['name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data['normalized_values'] as $key => $normalized)
            <tr>
                @if(isset($data['decision_matrix'][$key]))
                    <td>{{ $data['decision_matrix'][$key]['name'] }}</td>
                    @foreach($normalized as $value)
                    <td>{{ $value }}</td>
                    @endforeach
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Hasil Perankingan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Alternatif</th>
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['ranking'] as $rank)
            <tr>
                <td>{{ $rank['rank'] }}</td>
                <td>{{ $rank['name'] }}</td>
                <td>{{ $rank['utility'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
