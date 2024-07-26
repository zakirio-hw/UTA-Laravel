<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>UTA Method</h2>
    <form action="{{ route('calculate') }}" method="POST">
        @csrf
        <h3>Nama Kriteria dan Bobot</h3>
        <div id="kriteria">
            <div class="kriteria-row">
        <!--    <label for="nama_kriteria[]">Nama Kriteria 1:</label>
                <input type="text" name="nama_kriteria[]" required>
                <label for="bobot_kriteria[]">Bobot Kriteria 1:</label>
                <input type="number" name="bobot_kriteria[]" step="0.01" required>
                <select name="jenis_kriteria[]">
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select> -->
                <label for="nama_kriteria[]">Kriteria 1:</label>
                <input type="text" name="nama_kriteria[]" placeholder="Nama" required>
                <input type="number" name="bobot_kriteria[]" step="0.01" placeholder="Bobot" style="width: 1.6cm;" required>
                <select name="jenis_kriteria[]">
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="addKriteria()">Tambah Kriteria</button>
        <br><br>
        <h3>Nama Alternatif dan Nilai</h3>
        <div id="alternatif">
            <!-- <div class="alternatif-row">
                <label for="nama_alternatif[]">Nama Alternatif 1:</label>
                <input type="text" name="nama_alternatif[]" required>
                <label for="nilai[0][0]">Nilai Kriteria 1:</label>
                <input type="number" name="nilai[0][0]" step="0.01" required>
            </div> -->
            <table class="alternatif-row">
                <tr>
                    <td>
                        <label for="nama_alternatif[]">Alternatif 1:</label>
                        <input type="text" name="nama_alternatif[]" placeholder="Nama" required>
                    </td>
                    <td>
                        <label for="nilai[0][0]">Nilai Kriteria 1:</label>
                        <input type="number" name="nilai[0][0]" step="0.01" required>
                    </td>
                </tr>
            </table>
        </div>
        <button type="button" onclick="addAlternatif()">Tambah Alternatif</button>

        <br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
        let kriteriaCount = 1;
        let alternatifCount = 1;

        function addKriteria() {
            kriteriaCount++;
            const div = document.createElement('div');
            div.className = 'kriteria-row';
            // div.innerHTML = `
            //     <label for="nama_kriteria[]">Nama Kriteria ${kriteriaCount}:</label>
            //     <input type="text" name="nama_kriteria[]" required>
            //     <label for="bobot_kriteria[]">Bobot Kriteria ${kriteriaCount}:</label>
            //     <input type="number" name="bobot_kriteria[]" step="0.01" required>
            //     <select name="jenis_kriteria[]">
            //         <option value="benefit">Benefit</option>
            //         <option value="cost">Cost</option>
            //     </select>`; 
            div.innerHTML = `
                <label for="nama_kriteria[]">Kriteria ${kriteriaCount}:</label>
                <input type="text" name="nama_kriteria[]" placeholder="Nama">
                <input type="number" name="bobot_kriteria[]" step="0.01" placeholder="Bobot" style="width: 1.6cm;">
                <select name="jenis_kriteria[]">
                    <option value="benefit">Benefit</option>
                    <option value="cost">Cost</option>
                </select>`;
            document.getElementById('kriteria').appendChild(div);

            const alternatifRows = document.querySelectorAll('.alternatif-row');
            // alternatifRows.forEach((row, index) => {
            //     const newLabel = document.createElement('label');
            //     newLabel.innerHTML = `Nilai Kriteria ${kriteriaCount}:`;
            //     const newInput = document.createElement('input');
            //     newInput.type = 'number';
            //     newInput.name = `nilai[${index}][${kriteriaCount - 1}]`;
            //     newInput.step = '0.01';
            //     newInput.required = true;
            //     row.appendChild(newLabel);
            //     row.appendChild(newInput);
            // });
            alternatifRows.forEach((row, index) => {
                const newRow = document.createElement('tr');
                const newCol1 = document.createElement('td');
                const newCol2 = document.createElement('td');
                const newLabel = document.createElement('label');
                newLabel.innerHTML = `Nilai Kriteria ${kriteriaCount}:`;
                const newInput = document.createElement('input');
                newInput.type = 'number';
                newInput.name = `nilai[${index}][${kriteriaCount - 1}]`;
                newInput.step = '0.01';
                newInput.required = true;
                newCol2.appendChild(newLabel);
                newCol2.appendChild(newInput);
                newRow.appendChild(newCol1);
                newRow.appendChild(newCol2);
                row.appendChild(newRow);
            });
        }

        // function addAlternatif() {
        //     alternatifCount++;
        //     const table = document.createElement('table');
        //     table.className = 'alternatif-row';
        //     table.innerHTML = `
        //         <label for="nama_alternatif[]">Nama Alternatif ${alternatifCount}:</label>
        //         <input type="text" name="nama_alternatif[]" required>
        //         <label for="nilai[${alternatifCount - 1}][0]">Nilai Kriteria 1:</label>
        //         <input type="number" name="nilai[${alternatifCount - 1}][0]" step="0.01" required>
        //     `;
        //     for (let i = 1; i < kriteriaCount; i++) {
        //         const newLabel = document.createElement('label');
        //         newLabel.innerHTML = `Nilai Kriteria ${i + 1}:`;
        //         const newInput = document.createElement('input');
        //         newInput.type = 'number';
        //         newInput.name = `nilai[${alternatifCount - 1}][${i}]`;
        //         newInput.step = '0.01';
        //         newInput.required = true;
        //         table.appendChild(newLabel);
        //         table.appendChild(newInput);
        //     }
        //     document.getElementById('alternatif').appendChild(table);
        // }

        function addAlternatif() {
            alternatifCount++;
            const table = document.createElement('table');
            table.className = 'alternatif-row';
            table.innerHTML = `
                <tr>
                    <td>
                        <label for="nama_alternatif[]">Alternatif ${alternatifCount}:</label>
                        <input type="text" name="nama_alternatif[]" placeholder="Nama" required>
                    </td>
                    <td>
                        <label for="nilai[${alternatifCount - 1}][0]">Nilai Kriteria 1:</label>
                        <input type="number" name="nilai[${alternatifCount - 1}][0]" step="0.01" required>
                    </td>
                </tr>
            `;
            for (let i = 1; i < kriteriaCount; i++) {
                const newRow = document.createElement('tr');
                const newCol1 = document.createElement('td');
                const newCol2 = document.createElement('td');
                const newLabel = document.createElement('label');
                newLabel.innerHTML = `Nilai Kriteria ${i + 1}:`;
                const newInput = document.createElement('input');
                newInput.type = 'number';
                newInput.name = `nilai[${alternatifCount - 1}][${i}]`;
                newInput.step = '0.01';
                newInput.required = true;
                newCol2.appendChild(newLabel);
                newCol2.appendChild(newInput);
                newRow.appendChild(newCol1);
                newRow.appendChild(newCol2);
                row.appendChild(newRow);
            }
            document.getElementById('alternatif').appendChild(table);
        }
    </script>
</div>
@endsection
