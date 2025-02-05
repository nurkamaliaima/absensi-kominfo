@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan Keterlambatan ({{ $tanggal }})</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
