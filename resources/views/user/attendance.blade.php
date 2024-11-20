@extends('user.layouts')

@section('content')

<div class="card p-3 shadow rounded">
    <div id="msg"></div>
    <div>
        Hai <b>{{ ucfirst(session('username')) }}</b>, selamat datang di sistem absensi Dinas Kominfo Kab HSS. <br />
        <small>{{ date('D, d F Y') }}</small>
    </div>

    <hr />

    <div class="mt-3">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.128487959031!2d115.2662943!3d-2.7783200999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de50ac40be36cbf%3A0x3fda4a698261aa81!2sDinas%20Komunikasi%20dan%20Informatika%20Kab.%20Hulu%20Sungai%20Selatan!5e0!3m2!1sid!2sid!4v1731549138296!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="mb-3 text-center">
        <input type="hidden" id="user_id" value="{{ session('user_id') }}">
        <button class="btn btn-primary mt-3" id="attendance">Mulai Absen</button>
    </div>
    
    <div id="result"></div>
</div>

<script>
    // Event listener for attendance button click
    document.getElementById('attendance').addEventListener('click', function() {
        var userId = document.getElementById('user_id').value;

        if (!userId) {
            alert('User ID tidak ditemukan.');
            return;
        }

        // Show loading message
        document.getElementById('result').innerHTML = '<div class="alert alert-info">Memproses absensi...</div>';

        // Send attendance request via AJAX
        fetch('{{ url('doAttendance') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => response.json())
        .then(data => {
            // Show the result message
            document.getElementById('result').innerHTML = `<div class="alert alert-${data.status ? 'success' : 'danger'}">${data.message}</div>`;

            // Alert the user if they have already marked attendance
            if (!data.status) {
                alert(data.message);
            }
        })
        .catch(error => {
            // Log error and display message
            console.error('Error:', error);
            document.getElementById('result').innerHTML = '<div class="alert alert-danger">Terjadi kesalahan. Silakan coba lagi.</div>';
        });
    });
</script>

@endsection
