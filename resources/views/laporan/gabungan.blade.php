@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan Gabungan</h1>

    <!-- Tab Menu -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('laporan.gabungan', ['tanggal' => $tanggal, 'bulan' => $bulan]) }}">Laporan Gabungan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.harian') }}">Harian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.bulanan') }}">Bulanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.tidakhadir') }}">Tidak Hadir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.terlambat') }}">Terlambat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan.jamkerja') }}">Jam Kerja</a>
        </li>
    </ul>

    <!-- Konten Laporan Gabungan -->
    <table class="table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data -->
            @foreach($kehadiranHarian as $harian)
            <tr>
                <td>Harian</td>
                <td>{{ $harian->user->name ?? '-' }}</td>
                <td>{{ $harian->created_at }}</td>
            </tr>
            @endforeach
            <!-- Tambahkan data bulanan, terlambat, dll sesuai request -->
        </tbody>
    </table>
</div>
@endsection
