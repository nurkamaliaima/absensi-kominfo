<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Concession;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\LaporanKehadiranHarianResource;

class LaporanController extends Controller
{
    public function laporanGabungan(Request $request)
    {
        // Mengambil tanggal, bulan, dan tahun dari input
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        $bulan = $request->input('bulan', now()->format('Y-m'));
        $tahun = $request->input('tahun', now()->format('Y'));

        // Ambil data kehadiran harian berdasarkan tanggal
        $kehadiranHarian = Absensi::with('user')->whereDate('created_at', $tanggal)->get();

        // Ambil data kehadiran bulanan berdasarkan bulan
        $kehadiranBulanan = Absensi::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
            ->whereYear('created_at', date('Y', strtotime($bulan)))->get();

        // Ambil data pengguna yang tidak hadir pada tanggal tersebut
        $tidakHadir = User::whereDoesntHave('absensi', function ($q) use ($tanggal) {
            $q->whereDate('created_at', $tanggal);
        })->get();

        // Ambil data terlambat berdasarkan waktu absen
        $terlambat = Absensi::with('user')->whereDate('created_at', $tanggal)
            ->whereTime('created_at', '>=', '08:00:00')->get();

        // Ambil data jam kerja berdasarkan perhitungan absensi
        $jamKerja = Absensi::with('user')->whereDate('created_at', $tanggal)->get();

        // Kirim data ke view dengan tambahan 'type' sebagai gabungan
        return view('laporan.laporan', compact('kehadiranHarian', 'kehadiranBulanan', 'tidakHadir', 'terlambat', 'jamKerja', 'tanggal', 'bulan', 'tahun'))->with('type', 'gabungan');
    }

    public function laporanHarian(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        // $kehadiranHarian = Absensi::with('user')->whereDate('created_at', $tanggal)->get();
        $attendance = LaporanKehadiranHarianResource::collection(Absensi::with('user')->whereDate('created_at', $tanggal)->get());
        $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->whereDate('created_at', $tanggal)->get());

        $kehadiranHarian = array_merge(json_decode(json_encode($attendance)), json_decode(json_encode($concession)));

        // Kirim data ke view dengan tambahan 'type' sebagai harian
        return view('laporan.laporan', compact('kehadiranHarian', 'tanggal'))->with('type', 'harian');
    }

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m'));
        // $kehadiranBulanan = Absensi::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
        //     ->whereYear('created_at', date('Y', strtotime($bulan)))->get();
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

        // Kirim data ke view dengan tambahan 'type' sebagai bulanan
        return view('laporan.laporan', compact('kehadiranBulanan', 'bulan'))->with('type', 'bulanan');
    }

    public function laporanTidakHadir(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        // $tidakHadir = User::whereDoesntHave('absensi', function ($q) use ($tanggal) {
        //     $q->whereDate('created_at', $tanggal);
        // })->get();
        $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->whereDate('created_at', $tanggal)->get());
        $tidakHadir = array_merge(json_decode(json_encode($concession)));

        // Kirim data ke view dengan tambahan 'type' sebagai tidakhadir
        return view('laporan.laporan', compact('tidakHadir', 'tanggal'))->with('type', 'tidakhadir');
    }

    public function laporanTerlambat(Request $request)
    {
        // $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        // $terlambat = Absensi::with('user')->whereDate('created_at', $tanggal)
        //     ->whereTime('created_at', '>=', '08:00:00')->get();
        $jamKerja = '06:00:000';

        $bulan = $request->input('bulan', now()->format('Y-m'));
        $terlambat = Absensi::with('user')->whereMonth('created_at', date('m', strtotime($bulan)))
            ->whereYear('created_at', date('Y', strtotime($bulan)))
            ->whereTime('created_at', '>=', $jamKerja)->get();

        // Kirim data ke view dengan tambahan 'type' sebagai terlambat
        return view('laporan.laporan', compact('terlambat', 'bulan'))->with('type', 'terlambat');
    }

    public function laporanJamKerja(Request $request)
    {
        $tanggal = $request->input('tanggal', now()->format('Y-m-d'));
        $jamKerja = Absensi::with('user')->whereDate('created_at', $tanggal)->get();

        // Kirim data ke view dengan tambahan 'type' sebagai jamkerja
        return view('laporan.laporan', compact('jamKerja', 'tanggal'))->with('type', 'jamkerja');
    }

    public function laporanIndividu(Request $request)
    {
        $pesertaId = $request->input('pesertaId');
        $peserta = User::all();

        $kehadiran = [];

        if ($request->has('pesertaId')) {
            $attendance = LaporanKehadiranHarianResource::collection(Absensi::with('user')->where('user_id', $pesertaId)->get());
            $concession = LaporanKehadiranHarianResource::collection(Concession::with('user')->where('user_id', $pesertaId)->get());

            $kehadiran = array_merge(json_decode(json_encode($attendance)), json_decode(json_encode($concession)));

            usort($kehadiran, function ($a, $b) {
                return strtotime($a->created_at) - strtotime($b->created_at);
            });
        }

        return view('laporan.laporan', compact('peserta', 'pesertaId', 'kehadiran'))->with('type', 'individu');
    }
}
