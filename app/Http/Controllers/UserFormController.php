<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Pengajuan;
use App\Models\Commodity;

class UserFormController extends Controller
{
    public function show()
    {
        $commodity = Commodity::get();

        return view('pages.user.form', [
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
            // Tambahkan pesan kustom untuk setiap field yang wajib diisi
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
                $file_pengajuan = $file->store('uploads', 'public');
            }

            $form = Pengajuan::create([
                'name' => $request->input('name'),
                'date' => $request->input('date'),
                'sealing_mark' => $request->input('sealingmark'),
                'report_sealing' => $request->input('reportsealing'),
                'consignment_commodity' => $request->input('consignment'),
                'identification' => $request->input('identification'),
                'exporting_comp' => $request->input('company'),
                'address' => $request->input('address'),
                'regist_number' => $request->input('regisnumber'),
                'type_commodity' => $request->input('typecommodity'),
                'type_packing' => $request->input('packin'),
                'qty_package' => $request->input('quantity'),
                'weight' => $request->input('weight'),
                'volume' => $request->input('volume'),
                'type' => $request->input('type'),
                'file_pengajuan' => $file_pengajuan ?? null,
                'status' => 0,
                'userID' => Auth::user()->id,
            ]);

            DB::commit();

            Session::flash('success', 'Pengajuan telah berhasil disimpan.');

            return redirect()->route('form')->with('success', 'Pengajuan has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
