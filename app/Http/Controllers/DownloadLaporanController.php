<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Concession;
use App\Models\User;
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

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));

        $attendance = LaporanKehadiranHarianResource::collection(
            Absensi::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
            ->whereYear('created_at', date('Y', strtotime($bulan)))->get()
        );
        $concession = LaporanKehadiranHarianResource::collection(
            Concession::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
            ->whereYear('created_at', date('Y', strtotime($bulan)))->get()
        );

        $kehadiranBulanan = array_merge(json_decode(json_encode($attendance)), json_decode(json_encode($concession)));
        usort($kehadiranBulanan, function ($a, $b) {
            return strtotime($a->waktu) - strtotime($b->waktu);
        });

        $pdf = Pdf::loadView('admin.laporan_download.bulanan', [
            'kehadiranBulanan' => $kehadiranBulanan,
            'bulan'            => Carbon::parse($bulan)->locale('id')->isoFormat('MMMM Y'),
        ]);
        // return $pdf->download('example.pdf'); // Download the file
        return $pdf->stream(); // Show in browser
    }

    public function laporanTidakHadir(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));

        $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->whereDate('created_at', $tanggal)->get());
        $tidakHadir = array_merge(json_decode(json_encode($concession)));

        $pdf = Pdf::loadView('admin.laporan_download.tidak_hadir', [
            'tidakHadir' => $tidakHadir,
            'tanggal'    => Carbon::parse($tanggal)->locale('id')->isoFormat('D MMMM Y'),
        ]);
        // return $pdf->download('example.pdf'); // Download the file
        return $pdf->stream(); // Show in browser
    }

    public function laporanTerlambat(Request $request)
    {
        $jamKerja = '06:00:000';

        $bulan = $request->input('bulan', now()->format('Y-m'));
        $terlambat = Absensi::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
            ->whereYear('created_at', date('Y', strtotime($bulan)))
            ->whereTime('created_at', '>=', $jamKerja)->get();

        $pdf = Pdf::loadView('admin.laporan_download.terlambat', [
            'terlambat' => $terlambat,
            'bulan'     => Carbon::parse($bulan)->locale('id')->isoFormat('MMMM Y'),
        ]);
        // return $pdf->download('example.pdf'); // Download the file
        return $pdf->stream(); // Show in browser
    }

    public function laporanIndividu(Request $request)
    {
        $pesertaId = $request->input('pesertaId', '');

        $attendance = LaporanKehadiranHarianResource::collection(Absensi::with('user')->where('user_id', $pesertaId)->get());
        $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->where('user_id', $pesertaId)->get());

        $kehadiran = array_merge(json_decode(json_encode($attendance)), json_decode(json_encode($concession)));

        usort($kehadiran, function ($a, $b) {
            return strtotime($a->created_at) - strtotime($b->created_at);
        });

        $pdf = Pdf::loadView('admin.laporan_download.individu', [
            'kehadiran' => $kehadiran,
            'peserta'   => User::find($pesertaId),
        ]);
        // return $pdf->download('example.pdf'); // Download the file
        return $pdf->stream(); // Show in browser
    }
}
