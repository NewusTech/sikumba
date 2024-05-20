<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kalibrasi;
use App\Models\Commodity;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KalibrasiExport;
use Illuminate\Support\Facades\Storage;

class HistorykalibrasiController extends Controller
{
    public function index(Request $request)
    {
        $kalibrasi = Kalibrasi::orderBy('created_at', 'desc')->paginate(10);

        $userlogin = Auth::user()->id;
        $roleuserlogin = RoleUser::where('user_id', $userlogin)->first();
        $rolename = Role::where('id', $roleuserlogin->role_id)->first();

        return view('pages.history-kalibrasi', [
            'user' => Auth::user(),
            'rolename' => $rolename,
            'kalibrasi' => $kalibrasi
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');

        $kalibrasi = Kalibrasi::query();

        if ($search) {
            $kalibrasi->where('name', 'like', "%{$search}%");
        }

        if ($dateawal) {
            $kalibrasi->where('date', '>=', "{$dateawal}");
        }

        if ($dateakhir) {
            $kalibrasi->where('date', '<=', "{$dateakhir}");
        }

        $kalibrasi = $kalibrasi->orderBy('created_at', 'desc')->paginate(10);

        $userlogin = Auth::user()->id;
        $roleuserlogin = RoleUser::where('user_id', $userlogin)->first();
        $rolename = Role::where('id', $roleuserlogin->role_id)->first();

        return view('pages.history-kalibrasi-search', [
            'user' => Auth::user(),
            'rolename' => $rolename,
            'search' => $search,
            'kalibrasi' => $kalibrasi,
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|mimes:pdf|max:10000', // 2MB Max
        ]);

        $kalibrasi = Kalibrasi::find($request->kalibrasi_id);
        if ($request->hasFile('berkas')) {
            // Delete the old file
            if ($kalibrasi->berkas && Storage::disk('public')->exists($kalibrasi->berkas)) {
                Storage::disk('public')->delete($kalibrasi->berkas);
            }

            // Save the new file
            $filename = $request->berkas->store('sertif2', 'public');
            $kalibrasi->update(['berkas' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function uploadLaporan(Request $request)
    {
        $request->validate([
            'berkas_laporan' => 'required|file|mimes:pdf|max:10000', // 2MB Max
        ]);

        $kalibrasi = Kalibrasi::find($request->kalibrasi_idLap);
        if ($request->hasFile('berkas_laporan')) {
            // Delete the old file
            if ($kalibrasi->berkas_laporan && Storage::disk('public')->exists($kalibrasi->berkas_laporan)) {
                Storage::disk('public')->delete($kalibrasi->berkas_laporan);
            }

            // Save the new file
            $filename = $request->berkas_laporan->store('laporan2', 'public');
            $kalibrasi->update(['berkas_laporan' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function uploadAnalis(Request $request)
    {
        $request->validate([
            'berkas_analis' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10000', // 2MB Max
        ]);

        $kalibrasi = Kalibrasi::find($request->kalibrasi_idAnalis);
        if ($request->hasFile('berkas_analis')) {
            // Delete the old file
            if ($kalibrasi->berkas_analis && Storage::disk('public')->exists($kalibrasi->berkas_analis)) {
                Storage::disk('public')->delete($kalibrasi->berkas_analis);
            }

            // Save the new file
            $filename = $request->berkas_analis->store('analis2', 'public');
            $kalibrasi->update(['berkas_analis' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function edit($id)
    {
        $history = Kalibrasi::find($id);
        return view('pages.edit-kalibrasi', compact('history'), [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $history = Kalibrasi::find($id);
        $history->name = $request->get('name');
        $history->date = $request->get('date');
        $history->address = $request->input('address');
        $history->nama_alat = $request->input('nama_alat');
        $history->merek_alat = $request->input('merek_alat');
        $history->serial_number_alat = $request->input('serial_number_alat');
        $history->kapasitas = $request->input('kapasitas');
        $history->area_kalibrasi = $request->input('area_kalibrasi');

        $history->save();

        return redirect()->route('history-kalibrasi')->with('success', 'Kalibrasi updated successfully');
    }

    public function approvekalibrasi($id)
    {
        $item = Kalibrasi::find($id);

        if ($item) {
            $item->increment('status');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    public function approvekalibrasiBayar(Request $request)
    {
        $request->validate([
            'berkas' => 'required', // 2MB Max
        ]);
        $item = Kalibrasi::find($request->bukti_id);

        if ($request->hasFile('berkas')) {
            // Delete the old file
            if ($item->berkas && Storage::disk('public')->exists($item->berkas)) {
                Storage::disk('public')->delete($item->berkas);
            }

            // Save the new file
            $filename = $request->berkas->store('bukti', 'public');
            $item->update(['bukti_pembayaran_kalibrasi' => $filename]);
        }

        if ($item) {
            $item->increment('user_confirm');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    public function approvekalibrasiBayarAdmin(Request $request)
    {
        $item = Kalibrasi::find($request->bukti_id);

        if ($item) {
            $item->increment('admin_confirm');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    public function exportToExcel(Request $request)
    {
        $search = $request->input('searchh');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');
        $filename = 'kalibrasi' . date('Ymd_His') . '.xlsx';

        return Excel::download(new KalibrasiExport($search, $dateawal, $dateakhir), $filename);
    }
}
