@extends('layouts.laporan')

@section('content')
    <p class="text-center font-weight-bold mt-2 mb-0" style="font-size: 20px">Laporan Terlambat</p>
    <p class="text-center" style="font-size: 18px">Bulan : {{ $bulan }}</p>
    <table class="my-2 table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($terlambat as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
