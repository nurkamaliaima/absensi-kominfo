@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan</h1>

    <!-- Form Filter -->
    <form method="GET" action="{{ url()->current() }}">
        <div class="form-row">
            <!-- Filter untuk Laporan Harian, Tidak Hadir, Terlambat, Jam Kerja -->
            @if(request()->is('laporan/harian') || request()->is('laporan/tidakhadir') || request()->is('laporan/terlambat') || request()->is('laporan/jamkerja'))
            <div class="form-group col-md-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal ?? now()->format('Y-m-d') }}">
            </div>
            @endif

            <!-- Filter untuk Laporan Bulanan -->
            @if(request()->is('laporan/bulanan'))
            <div class="form-group col-md-3">
                <label for="bulan">Bulan</label>
                <input type="month" name="bulan" id="bulan" class="form-control" value="{{ $bulan ?? now()->format('Y-m') }}">
            </div>
            @endif

            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tab Menu -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/gabungan') ? 'active' : '' }}" href="{{ route('laporan.gabungan') }}">Laporan Gabungan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/harian') ? 'active' : '' }}" href="{{ route('laporan.harian') }}">Harian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/bulanan') ? 'active' : '' }}" href="{{ route('laporan.bulanan') }}">Bulanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/tidakhadir') ? 'active' : '' }}" href="{{ route('laporan.tidakhadir') }}">Tidak Hadir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/terlambat') ? 'active' : '' }}" href="{{ route('laporan.terlambat') }}">Terlambat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/jamkerja') ? 'active' : '' }}" href="{{ route('laporan.jamkerja') }}">Jam Kerja</a>
        </li>
    </ul>

    <!-- Konten Laporan Gabungan -->
    @if(request()->is('laporan/gabungan'))
    <h3>Laporan Gabungan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadiranHarian as $harian)
            <tr>
                <td>Harian</td>
                <td>{{ $harian->user->name ?? '-' }}</td>
                <td>{{ $harian->created_at }}</td>
            </tr>
            @endforeach
            @foreach($kehadiranBulanan as $bulanan)
            <tr>
                <td>Bulanan</td>
                <td>{{ $bulanan->user->name ?? '-' }}</td>
                <td>{{ $bulanan->created_at }}</td>
            </tr>
            @endforeach
            @foreach($terlambat as $item)
            <tr>
                <td>Terlambat</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
            @foreach($jamKerja as $item)
            <tr>
                <td>Jam Kerja</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Laporan Harian -->
    @if(request()->is('laporan/harian'))
    <h3>Laporan Harian ({{ $tanggal }})</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadiranHarian as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Laporan Bulanan -->
    @if(request()->is('laporan/bulanan'))
    <h3>Laporan Bulanan ({{ $bulan }})</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadiranBulanan as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Laporan Tidak Hadir -->
    @if(request()->is('laporan/tidakhadir'))
    <h3>Laporan Tidak Hadir ({{ $tanggal }})</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tidakHadir as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>Belum Absen</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Laporan Terlambat -->
    @if(request()->is('laporan/terlambat'))
    <h3>Laporan Terlambat ({{ $tanggal }})</h3>
    <table class="table">
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
    @endif

    <!-- Laporan Jam Kerja -->
    @if(request()->is('laporan/jamkerja'))
    <h3>Laporan Jam Kerja ({{ $tanggal }})</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jamKerja as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
