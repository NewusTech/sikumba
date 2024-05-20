<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Sertifikat;

class SertifikatMasterController extends Controller
{

    // public function index()
    // {
    //     return view('pages.admin.create-sertification', ['user' => Auth::user()]);
    // }

    public function show()
    {
        $sertification = Sertifikat::first();


        return view('pages.admin.create-sertification', [
            'user' => Auth::user(),
            'sertification' => $sertification,
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        // Ambil data dari request
        $data = $request->all();

        // Tentukan kriteria untuk mencari data yang sudah ada
        $sertification = [
            'kepala_dinas' => $data['kepala_dinas'],
            'nip' => $data['nip'],
            'kepala_bpsmb' => $data['kepala_bpsmb'],
            'nip_bpsmb' => $data['nip_bpsmb'],
            'technical_manager' => $data['technical_manager'],
            'nip_manager' => $data['nip_manager'],
            'no_lab' => $data['no_lab'],
        ];

        // Cek apakah data sudah ada berdasarkan kriteria
        $sertification = Sertifikat::first();

        // Jika data sudah ada, lakukan update
        if ($sertification) {
            $sertification->update($data);

            return redirect()->route('data-sertifikat')->with('success', 'Sertifikat has been updated successfully');
        }

        // Jika data belum ada, lakukan create
        Sertifikat::create($data);

        return redirect()->route('data-sertifikat')->with('success', 'Sertifikat has been created successfully');
    }

}
