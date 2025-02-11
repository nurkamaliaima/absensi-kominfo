@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
@if(session('role_id') == 1)
<h1 class="h3 mb-2 text-gray-800">Manajemen Kehadiran</h1>
<p class="mb-4">Disini fitur untuk menyunting dan menghapus data absen pengguna.</p>
@else
<h1 class="h3 mb-2 text-gray-800">Daftar Kehadiran</h1>
@endif
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {!! session('message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- <div class="text-right">
            <a href="{{ url('attendance/create') }}" class="btn btn-success m-2"> <i class="fas fa-plus mr-1"></i> New attendance</a>
        </div> -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Waktu Kehadiran</th>
                        @if(session('role_id') !== 3)
                        <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ optional($attendance->user)->name }}</td>
                        <td>{{ $attendance->user ? $attendance->user->name : 'Unknown User' }}</td>
                        <td>{{ date('d F Y H:m:i', strtotime($attendance->present_at)) }}</td>
                        <td>{{ $attendance->description }}</td>
                        @if(session('role_id') !== 3)
                        <td>
                            <a href="{{ url('attendance/' . $attendance->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ url('attendance/' . $attendance->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah anda yakin akan dihapus?')" class="bg-danger text-white" style="border: 0px"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
