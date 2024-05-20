<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{

    public function show()
    {
        $logo = Logo::first();

        return view('pages.admin.create-logo', [
            'user' => Auth::user(),
            'logo' => $logo,
        ]);
    }

    public function createOrUpdate(Request $request)
    {
        // Ambil data dari request
        $data = $request->all();
    
        // Cari logo yang sudah ada
        $logo = Logo::first();
    
        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($logo && $logo->foto && Storage::disk('public')->exists($logo->foto)) {
                Storage::disk('public')->delete($logo->foto);
            }
    
            // Simpan foto yang baru diunggah
            $data['foto'] = $request->file('foto')->store('logo', 'public');
        }
    
        // Jika data sudah ada, lakukan update
        if ($logo) {
            $logo->update($data);
            return redirect()->route('logo')->with('success', 'Logo has been updated successfully');
        }
    
        // Jika $logo null, maka buat data baru
        Logo::create($data);
        return redirect()->route('logo')->with('success', 'Logo has been created successfully');
    }
    


}
