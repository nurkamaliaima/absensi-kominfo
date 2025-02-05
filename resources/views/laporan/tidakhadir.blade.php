@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan Tidak Hadir ({{ $tanggal }})</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $user)
            <tr>
                <td>{{ $user->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="1">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
