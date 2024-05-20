<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->roles->contains('name', 'Admin')) {
            // Lakukan aksi untuk admin

            // Menambahkan log info
            Log::info('Pengguna dengan ID ' . $user->id . ' adalah seorang admin.');
        }

        return view('pages.dashboard', ['user' => Auth::user()]);
        
    }
}
