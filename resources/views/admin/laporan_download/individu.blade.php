@extends('layouts.laporan')

@section('content')
    <p class="text-center font-weight-bold mt-2 mb-0" style="font-size: 20px">Laporan Kehadiran Peserta Magang</p>
    <p class="text-center" style="font-size: 18px">Nama : {{ $peserta->name }}</p>
    <table class="my-2 table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Status Kehadiran</th>
                <th scope="col">Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadiran as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->waktu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
