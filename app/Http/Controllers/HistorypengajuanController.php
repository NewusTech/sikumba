<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Commodity;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanExport;
use Illuminate\Support\Facades\Storage;

class HistorypengajuanController extends Controller
{
    public function index(Request $request)
    {
        $pengajuan = Pengajuan::orderBy('created_at', 'desc')->paginate(10);

        $commodity = Commodity::get();

        $userlogin = Auth::user()->id;
        $roleuserlogin = RoleUser::where('user_id', $userlogin)->first();
        $rolename = Role::where('id', $roleuserlogin->role_id)->first();

        return view('pages.history-pengajuan', [
            'user' => Auth::user(),
            'rolename' => $rolename,
            'pengajuan' => $pengajuan,
            'commodity' => $commodity
        ]);
    }

    public function exportToExcel(Request $request)
    {
        $search = $request->input('searchh');
        $commodity = $request->input('commodity');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');
        $filename = 'pengajuan_' . date('Ymd_His') . '.xlsx';
        info('asd', ['a' => $search, $commodity, $dateawal, $dateakhir]);

        return Excel::download(new PengajuanExport($search, $commodity, $dateawal, $dateakhir), $filename);
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $commodity = $request->input('commodity');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');

        info($dateawal);
        info($dateakhir);

        $pengajuan = Pengajuan::query();

        if ($search) {
            $pengajuan->where('name', 'like', "%{$search}%");
        }

        if ($commodity) {
            $pengajuan->where('type_commodity', $commodity);
        }

        if ($dateawal) {
            $pengajuan->where('date', '>=', "{$dateawal}");
        }

        if ($dateakhir) {
            $pengajuan->where('date', '<=', "{$dateakhir}");
        }

        $pengajuan = $pengajuan->orderBy('created_at', 'desc')->paginate(10);

        $userlogin = Auth::user()->id;
        $roleuserlogin = RoleUser::where('user_id', $userlogin)->first();
        $rolename = Role::where('id', $roleuserlogin->role_id)->first();

        return view('pages.history-pengajuan-search', [
            'user' => Auth::user(),
            'rolename' => $rolename,
            'search' => $search,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|mimes:pdf|max:10000', // 2MB Max
        ]);

        $pengajuan = Pengajuan::find($request->pengajuan_id);
        if ($request->hasFile('berkas')) {
            // Delete the old file
            if ($pengajuan->berkas && Storage::disk('public')->exists($pengajuan->berkas)) {
                Storage::disk('public')->delete($pengajuan->berkas);
            }

            // Save the new file
            $filename = $request->berkas->store('sertif', 'public');
            $pengajuan->update(['berkas' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function uploadLaporan(Request $request)
    {
        $request->validate([
            'berkas_laporan' => 'required|file|mimes:pdf|max:10000', // 2MB Max
        ]);

        // info($request->hasFile('berkas_laporan'));

        $pengajuan = Pengajuan::find($request->pengajuan_idLap);
        if ($request->hasFile('berkas_laporan')) {
            // Delete the old file
            if ($pengajuan->berkas_laporan && Storage::disk('public')->exists($pengajuan->berkas_laporan)) {
                Storage::disk('public')->delete($pengajuan->berkas_laporan);
            }

            // Save the new file
            $filename = $request->berkas_laporan->store('laporan', 'public');
            $pengajuan->update(['berkas_laporan' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function uploadAnalis(Request $request)
    {
        $request->validate([
            'berkas_analis' => 'required|file|max:10000', // 2MB Max
        ]);

        $pengajuan = Pengajuan::find($request->pengajuan_idAnalis);
        if ($request->hasFile('berkas_analis')) {
            // Delete the old file
            if ($pengajuan->berkas_analis && Storage::disk('public')->exists($pengajuan->berkas_analis)) {
                Storage::disk('public')->delete($pengajuan->berkas_analis);
            }

            // Save the new file
            $filename = $request->berkas_analis->store('analis', 'public');
            $pengajuan->update(['berkas_analis' => $filename]);
        }

        return back()->with('success', 'File updated successfully.');
    }

    public function edit($id)
    {
        $userlogin = Auth::user()->id;
        $roleuserlogin = RoleUser::where('user_id', $userlogin)->first();
        $rolename = Role::where('id', $roleuserlogin->role_id)->first();

        $history = Pengajuan::find($id);

        return view('pages.edit-history', compact('history'), [
            'rolename' => $rolename,
            'user' => Auth::user()
        ]);
    }

    public function sertif($id)
    {
        $history = Pengajuan::find($id);
        return view('pages.edit-sertif', compact('history'), [
            'user' => Auth::user()
        ]);
    }

    public function laporan($id)
    {
        $history = Pengajuan::find($id);
        return view('pages.edit-laporan', compact('history'), [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request, $id)
    {
        
        if ($request->hasFile('file')) {
            // Simpan foto yang baru diunggah
            $file = $request->file('file');
            $biaya = $file->store('biaya', 'public');
        }

        $history = Pengajuan::find($id);
        $history->biaya = $biaya ?? null;
        $history->name = $request->get('name');
        $history->date = $request->get('date');
        $history->sealing_mark = $request->get('sealing_mark');
        $history->report_sealing = $request->get('report_sealing');
        $history->consignment_commodity = $request->get('consignment_commodity');
        $history->identification = $request->get('identification');
        $history->exporting_comp = $request->get('exporting_comp');
        $history->address = $request->get('address');
        $history->regist_number = $request->get('regist_number');
        $history->type_packing = $request->get('type_packing');
        $history->qty_package = $request->get('qty_package');
        $history->weight = $request->get('weight');
        $history->volume = $request->get('volume');

        $history->save();

        return redirect()->route('history-pengajuan')->with('success', 'Pengajuan updated successfully');
    }

    public function updatesertif(Request $request, $id)
    {
        $history = Pengajuan::find($id);
        $history->noserial_surat = $request->get('noserial_surat');
        $history->sample_desc_surat = $request->get('sample_desc_surat');
        $history->code_number_surat = $request->get('code_number_surat');
        $history->no_surat = $request->get('no_surat');
        $history->commodity_surat = $request->get('commodity_surat');
        $history->received_surat = $request->get('received_surat');
        $history->testing_surat = $request->get('testing_surat');
        $history->no_sni = $request->get('no_sni');
        $history->grade = $request->get('grade');
        $history->note_sertif = $request->get('note_sertif');

        // Mengambil data detail dari request
        $detailData = $request->get('detail');

        // Jika ada data detail yang dikirimkan
        if ($detailData) {
            // Menginisialisasi array untuk menyimpan detail
            $details = [];

            // Melakukan iterasi untuk setiap data detail yang dikirimkan
            foreach ($detailData as $detail) {
                // Menambahkan data detail ke dalam array
                $details[] = [
                    'characteristic' => $detail['characteristic'],
                    'method' => $detail['method'],
                    'unit' => $detail['unit'],
                    'test' => $detail['test'],
                    'grade' => $detail['grade']
                ];
            }

            // Mengubah array detail menjadi format JSON
            $history->detail = json_encode($details);
        }

        $history->save();

        return redirect()->route('history-pengajuan')->with('success', 'Pengajuan updated successfully');
    }

    public function updatelaporan(Request $request, $id)
    {
        $history = Pengajuan::find($id);
        $history->no_laporan = $request->get('no_laporan');
        $history->commodity_surat = $request->get('commodity_surat');
        $history->sample_desc_surat = $request->get('sample_desc_surat');
        $history->commodity_surat = $request->get('commodity_surat');
        $history->received_surat = $request->get('received_surat');
        $history->analisdate_surat = $request->get('analisdate_surat');
        $history->note_laporan = $request->get('note_laporan');

        // Mengambil data detail dari request
        $detailData = $request->get('detail_laporan');

        // Jika ada data detail yang dikirimkan
        if ($detailData) {
            // Menginisialisasi array untuk menyimpan detail
            $details = [];

            // Melakukan iterasi untuk setiap data detail yang dikirimkan
            foreach ($detailData as $detail) {
                // Menambahkan data detail ke dalam array
                $details[] = [
                    'code' => $detail['code'],
                    'characteristic' => $detail['characteristic'],
                    'unit' => $detail['unit'],
                    'test' => $detail['test'],
                    'method' => $detail['method'],
                ];
            }

            // Mengubah array detail menjadi format JSON
            $history->detail_laporan = json_encode($details);
        }

        $history->save();

        return redirect()->route('history-pengajuan')->with('success', 'Pengajuan updated successfully');
    }

    public function approve($id)
    {
        $item = Pengajuan::find($id);

        if ($item) {
            $item->increment('status');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    public function approveBayar(Request $request)
    {

        $request->validate([
            'berkas' => 'required', // 2MB Max
        ]);
        $item = Pengajuan::find($request->bukti_id);

        info($request->file('berkas'));
        if ($request->hasFile('berkas')) {
            // Delete the old file
            if ($item->bukti_pembayaran_pengujian && Storage::disk('public')->exists($item->bukti_pembayaran_pengujian)) {
                Storage::disk('public')->delete($item->bukti_pembayaran_pengujian);
            }

            // Save the new file
            $filename = $request->berkas->store('bukti', 'public');
            $item->update(['bukti_pembayaran_pengujian' => $filename]);
        }

        if ($item) {
            $item->increment('user_confirm');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    public function approveBayarAdmin(Request $request)
    {
        $item = Pengajuan::find($request->bukti_id);

        if ($item) {
            $item->increment('admin_confirm');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }
}
