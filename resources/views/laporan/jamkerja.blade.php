@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan Jam Kerja ({{ $bulan }})</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Total Jam Kerja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $user_id => $items)
            <tr>
                <td>{{ $items->first()->user->name ?? '-' }}</td>
                <td>{{ $items->sum(fn($item) => optional($item->jam_keluar)->diffInHours($item->jam_masuk) ?? 0) }} jam</td>
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
