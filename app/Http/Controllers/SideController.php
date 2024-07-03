<?php

namespace App\Http\Controllers;

use App\Models\Kontak;

class SideController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first(); // Mengambil kontak pertama
        return view('sidebar', compact('kontak'));
    }
}
