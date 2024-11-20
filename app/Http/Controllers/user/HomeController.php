<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Concession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        if (!session()->has('username')) {
            return back();
        }
        return view('user.home');
    }

    // Menampilkan halaman about
    public function about()
    {
        if (!session()->has('username')) {
            return back();
        }
        return view('user.about');
    }

    // Menampilkan halaman guide
    public function guide()
    {
        if (!session()->has('username')) {
            return back();
        }
        return view('user.guide');
    }

    // Menampilkan halaman untuk meminta izin
    public function concession()
    {
        if (!session()->has('username')) {
            return back();
        }
        return view('user.concession');
    }

    // Menyimpan data izin (concession)
    public function store_concession(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        // Membuat izin baru
        Concession::create([
            'user_id' => session('user_id'),
            'reason' => $request->reason,
            'description' => $request->description,
            'created_at' => now(),
        ]);

        return redirect('user/home')->with('message', 'Concession has been created!');
    }

    // Menampilkan riwayat absensi dan izin
    public function show_history()
    {
        $user_id = session('user_id');

        // Mengambil data absensi dan izin dari user
        $histories = DB::select("
            SELECT id, present_at, description, created_at FROM attendance WHERE user_id = ?
            UNION
            SELECT id, reason, description, created_at FROM concession WHERE user_id = ?
            ORDER BY created_at DESC
            LIMIT 7
        ", [$user_id, $user_id]);

        return view('user.history-attendance', compact('histories'));
    }

    // Menampilkan halaman absensi
    public function attendance()
    {
        return view('user.attendance');
    }

    // Proses absen
    public function do_attendance(Request $request)
    {
        try {
            // Validasi input user_id
            $request->validate([
                'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            ]);

            // Cek apakah user sudah absen hari ini
            $attendance_status = Attendance::where('user_id', $request->user_id)
                ->whereDate('present_at', Carbon::today())
                ->first();

            // Jika belum absen
            if (!$attendance_status) {
                Attendance::create([
                    'user_id' => $request->user_id,
                    'present_at' => Carbon::now(),
                    'description' => 'Hadir',
                    'created_at' => Carbon::now(),
                ]);

                return response()->json([
                    "message" => "Thank you for your attendance!",
                    "status"  => true,
                ]);
            } else {
                // Jika sudah absen hari ini
                return response()->json([
                    'message'  => 'Anda sudah absen hari ini!',
                    'status'   => false,
                ]);
            }

        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error('Attendance Error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
                'status' => false,
            ], 500);
        }
    }
}
