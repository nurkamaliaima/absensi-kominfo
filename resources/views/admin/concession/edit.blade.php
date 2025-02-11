@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<a href="{{ url('concession') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>

<h1 class="h3 m-4 text-gray-800">Edit Perizinan</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ url('concession') }}/{{ $concession->id }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <div class="col-md-6 mt-2">
                    <label for="">Nama</label>
                    <select name="user_id" id="" class="form-control">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $concession->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Alasan</label>
                    <select name="reason" class="form-control">
                        <option value="sakit" {{ $concession->reason == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ $concession->reason == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="cuti" {{ $concession->reason == 'cuti' ? 'selected' : '' }}>Cuti</option>
                    </select>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="">Deskripsi</label>
                    <textarea name="description" class="form-control">{{ $concession->description }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
