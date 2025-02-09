@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Laporan</h1>

    <!-- Form Filter -->
    <form method="GET" action="{{ url()->current() }}">
        <div class="form-row">
            <!-- Filter untuk Laporan Harian, Tidak Hadir, Terlambat, Jam Kerja -->
            @if(request()->is('laporan/harian') || request()->is('laporan/tidakhadir') || request()->is('laporan/jamkerja'))
            <div class="form-group col-md-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal ?? now()->format('Y-m-d') }}">
            </div>
            @endif

            <!-- Filter untuk Laporan Bulanan -->
            @if(request()->is('laporan/bulanan') || request()->is('laporan/terlambat'))
            <div class="form-group col-md-3">
                <label for="bulan">Bulan</label>
                <input type="month" name="bulan" id="bulan" class="form-control" value="{{ $bulan ?? now()->format('Y-m') }}">
            </div>
            @endif

            <!-- Filter untuk Laporan Individu -->
            @if(request()->is('laporan/individu'))
            <div class="form-group col-md-3">
                <label for="bulan">Peserta Magang</label>
                <select name="pesertaId" id="pesertaId" class="custom-select form-control">
                    <option selected>Pilih Peserta Magang</option>
                    @foreach ($peserta as $p)
                        <option value={{ $p->id }} {{ $p->id == $pesertaId ? "selected" : "" }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="form-group col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tab Menu -->
    <ul class="nav nav-tabs mb-4">
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/gabungan') ? 'active' : '' }}" href="{{ route('laporan.gabungan') }}">Laporan Gabungan</a>
        </li> --}}
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
            <a class="nav-link {{ request()->is('laporan/individu') ? 'active' : '' }}" href="{{ route('laporan.individu') }}">Individu</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->is('laporan/jamkerja') ? 'active' : '' }}" href="{{ route('laporan.jamkerja') }}">Jam Kerja</a>
        </li> --}}
    </ul>

    <!-- Konten Laporan Gabungan -->
    {{-- @if(request()->is('laporan/gabungan'))
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
    @endif --}}

    <!-- Laporan Harian -->
    @if(request()->is('laporan/harian'))
    <h3>Laporan Harian ({{ $tanggal }})</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Status Kehadiran</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($kehadiranHarian as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach --}}
            @foreach($kehadiranHarian as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->waktu }}</td>
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
                <th>Status Kehadiran</th>
                <th>Waktu Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadiranBulanan as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->waktu }}</td>
            </tr>
            @endforeach
            {{-- @foreach($kehadiranBulanan as $item)
            <tr>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach --}}
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
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tidakHadir as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ date('Y-m-d', strtotime($item->waktu)) }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            {{-- @foreach($tidakHadir as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>Belum Absen</td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
    @endif

    <!-- Laporan Terlambat -->
    @if(request()->is('laporan/terlambat'))
    <h3>Laporan Terlambat ({{ $bulan }})</h3>
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

    <!-- Laporan Terlambat -->
    @if(request()->is('laporan/individu'))
    <h3>Laporan Kehadiran Peserta Magang</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Status Kehadiran</th>
                <th>Waktu Kehadiran</th>
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
