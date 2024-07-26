@extends('layouts.app')

@section('content')
<h2>History Perhitungan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($histories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td>{{ $history->created_at }}</td>
                <td>
                    <form action="{{ route('delete.history', $history->id) }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form action="{{ route('recalculate.history', $history->id) }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">Recalculate</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
