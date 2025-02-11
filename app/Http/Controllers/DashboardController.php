<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Concession;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return back();
        }
        // $users = DB::table('users')->count();
        // $concessions = DB::table('concession')->count();
        // $attendances = DB::table('attendance')->count();
        // $roles = DB::table('roles')->count();

        $users = User::all()->count();
        $concessions = Concession::all()->count();
        $attendances = Absensi::all()->count();
        $roles = Role::all()->count();

        return view('admin.dashboard', compact('users', 'concessions', 'attendances', 'roles'));
    }
}
