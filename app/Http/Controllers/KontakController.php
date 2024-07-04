<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Kontak;

class KontakController extends Controller
{

    public function show()
    {
        $kontak = Kontak::first();


        return view('pages.admin.create-kontak', [
            'user' => Auth::user(),
            'kontak' => $kontak,
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        // Ambil data dari request
        $data = $request->all();

        // Tentukan kriteria untuk mencari data yang sudah ada
        $kontak = [
            'no_telephone' => $data['no_telephone'],
        ];

        // Cek apakah data sudah ada berdasarkan kriteria
        $kontak = Kontak::first();

        // Jika data sudah ada, lakukan update
        if ($kontak) {
            $kontak->update($data);

            return redirect()->route('kontak')->with('success', 'Kontak has been updated successfully');
        }

        // Jika data belum ada, lakukan create
        Kontak::create($data);

        return redirect()->route('kontak')->with('success', 'Kontak has been created successfully');
    }

}
