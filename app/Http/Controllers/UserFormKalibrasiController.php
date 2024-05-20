<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Kalibrasi;
use App\Models\Commodity;

class UserFormKalibrasiController extends Controller
{
    public function show()
    {
        $commodity = Commodity::get();
        
        return view('pages.user.formkalibrasi', [
            'commodity' => $commodity,
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
        ], [
            'name.required' => 'Field nama harus diisi.',
            'date.required' => 'Field tanggal harus diisi.',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();

            if ($request->hasFile('file')) {
                // Simpan foto yang baru diunggah
                $file = $request->file('file');
                $file_pengajuan = $file->store('uploads2', 'public');
            }

            $form = Kalibrasi::create([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'address' => $request->input('address'),
                'nama_alat' => $request->input('nama_alat'),
                'merek_alat' => $request->input('merek_alat'),
                'serial_number_alat' => $request->input('serial_number_alat'),
                'kapasitas' => $request->input('kapasitas'),
                'area_kalibrasi' => $request->input('area_kalibrasi'),
                'file_pengajuan' => $file_pengajuan ?? null,
                'status' => 0,
                'userID' => Auth::user()->id,
            ]);

            DB::commit();

            Session::flash('success', 'Form kalibrasi telah berhasil disimpan.');


            return redirect()->route('formkalibrasi')->with('success', 'Form kalibrasi has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
