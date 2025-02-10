@extends('layouts.laporan')

@section('content')
    <p class="text-center font-weight-bold mt-2 mb-0" style="font-size: 20px">Laporan Tidak Hadir</p>
    <p class="text-center" style="font-size: 18px">Tanggal : {{ $tanggal }}</p>
    <table class="my-2 table table-bordered">
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Alasan Ketidakhadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tidakHadir as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ date('Y-m-d', strtotime($item->waktu)) }}</td>
                <td>
                    <p class="mb-0">{{ $item->status }}</p>
                    <p class="mb-0">Keterangan: {{ $item->keterangan }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
