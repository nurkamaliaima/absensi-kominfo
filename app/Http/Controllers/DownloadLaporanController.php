<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Concession;
use App\Http\Resources\LaporanKehadiranHarianResource;
use Illuminate\Http\Request;

class DownloadLaporanController extends Controller
{
    public function laporanHarian(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));

        $attendance = LaporanKehadiranHarianResource::collection(Absensi::with('user')->whereDate('created_at', $tanggal)->get());
        $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->whereDate('created_at', $tanggal)->get());

        $kehadiranHarian = array_merge(json_decode(json_encode($attendance)), json_decode(json_encode($concession)));

        $pdf = Pdf::loadView('admin.laporan_download.harian', [
            'kehadiranHarian' => $kehadiranHarian,
            'tanggal'         => Carbon::parse($tanggal)->locale('id')->isoFormat('D MMMM Y'),
        ]);
        // return $pdf->download('example.pdf'); // Download the file
        return $pdf->stream(); // Show in browser
    }
}
