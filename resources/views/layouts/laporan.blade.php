<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Aplikasi Absensi Berbasis Lokasi</title>
</head>

<body>
    <div class="border-bottom border-dark pb-2 w-100">
        <div class="float-left pt-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/ff/Lambang_Kabupaten_Hulu_Sungai_Selatan.png" alt="Logo Hulu Sungai Selatan" class="" style="width: 5rem">
        </div>
        <div class="d-inline-block text-center w-75">
            <p class="mb-0" style="font-size: 16px">PEMERINTAH KABUPATEN HULU SUNGAI SELATAN</p>
            <p class="mb-0 font-weight-bold" style="font-size: 22px">DINAS KOMUNIKASI DAN INFORMATIKA</p>
            <p class="mb-0" style="font-size: 14px">Jalan Aluh Idut Nomor 66 A Telepon (0517) 21230</p>
            <p class="mb-0" style="font-size: 14px">Kandangan 71212</p>
        </div>
    </div>
    @yield('content')
    <div class="my-5 float-right pr-5">
        <p class="mb-0">Mengetahui,</p>
        <p class="mb-0">KEPALA DINAS</p>
        <br />
        <br />
        <br />
        <p class="mb-0 font-weight-bold">Hj. RAHMAWATY, ST., MT.</p>
        <p class="mb-0">Pembina Utama Muda</p>
        <p>NIP. 19710726 199703 2 005</p>
    </div>
</body>
