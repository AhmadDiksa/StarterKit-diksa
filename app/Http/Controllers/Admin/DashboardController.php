<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // Logika data untuk Admin
            // Contoh: Hitung jumlah user, berita, dll.
            return view('admin.dashboard.admin');
        }

        if ($user->hasRole('Editor')) {
            // Logika data untuk Editor
            // Contoh: Hitung berita yang menunggu approval
            $pendingBeritaCount = \App\Models\Berita::where('status', 'draft')->count();
            return view('admin.dashboard.editor', compact('pendingBeritaCount'));
        }

        if ($user->hasRole('Wartawan')) {
            // Logika data untuk Wartawan
            // Contoh: Hitung berita yang sudah ditulis
            $myBeritaCount = \App\Models\Berita::where('user_id', $user->id)->count();
            return view('admin.dashboard.wartawan', compact('myBeritaCount'));
        }

        // Fallback jika user tidak punya role
        return view('dashboard'); // Halaman dashboard generik
    }
}