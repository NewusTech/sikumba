<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\Kalibrasi;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Log;
use PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::user()->id;

        // Ambil data pengajuan berdasarkan user ID
        $pengajuan = Pengajuan::where('userID', $userId);

        // Lakukan paginasi dan kirimkan data ke view
        $pengajuan = $pengajuan->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.user.report-user', [
            'user' => Auth::user(),
            'search' => $search,
            'pengajuan' => $pengajuan
        ]);
    }

    public function search(Request $request)
    {

        $search = $request->input('query');
        $userId = Auth::user()->id;

        // Ambil data pengajuan berdasarkan user ID
        $pengajuan = Pengajuan::where('userID', $userId);

        // Filter berdasarkan tanggal
        if ($request->has('date')) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $pengajuan->whereDate('date', $date);
        }

        // Filter berdasarkan pencarian (search)
        if ($search) {
            $pengajuan->where('name', 'like', "%{$search}%");
        }

        // Lakukan paginasi dan kirimkan data ke view
        $pengajuan = $pengajuan->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.user.report-user-search', [
            'user' => Auth::user(),
            'search' => $search,
            'pengajuan' => $pengajuan
        ]);
    }

    public function indexkalibrasi(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::user()->id;

        // Ambil data pengajuan berdasarkan user ID
        $kalibrasi = Kalibrasi::where('userID', $userId);

        // Lakukan paginasi dan kirimkan data ke view
        $kalibrasi = $kalibrasi->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.user.report-kalibrasi-user', [
            'user' => Auth::user(),
            'search' => $search,
            'kalibrasi' => $kalibrasi
        ]);
    }

    public function searchkalibrasi(Request $request)
    {

        $search = $request->input('query');
        $userId = Auth::user()->id;

        // Ambil data pengajuan berdasarkan user ID
        $kalibrasi = Kalibrasi::where('userID', $userId);

        // Filter berdasarkan tanggal
        if ($request->has('date')) {
            $date = Carbon::parse($request->date)->format('Y-m-d');
            $kalibrasi->whereDate('date', $date);
        }

        // Filter berdasarkan pencarian (search)
        if ($search) {
            $kalibrasi->where('name', 'like', "%{$search}%");
        }

        // Lakukan paginasi dan kirimkan data ke view
        $kalibrasi = $kalibrasi->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.user.report-kalibrasi-user-search', [
            'user' => Auth::user(),
            'search' => $search,
            'kalibrasi' => $kalibrasi
        ]);
    }

    public function printpdf($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $sertification = Sertifikat::first();
        $data = [
            'pengajuan' => $pengajuan,
            'sertification' => $sertification,
            'title' => 'Sertifikat'
        ];
        // Load view untuk halaman pertama
        $page1 = view('pages.pdf', [
            'pengajuan' => $pengajuan,
            'sertification' => $sertification,
            'title' => 'Sertifikat'
        ])->render();

        // Load view untuk halaman kedua
        $page2 = view('pages.pdf2', [
            'pengajuan' => $pengajuan,
            'sertification' => $sertification,
            'title' => 'Sertifikat'
        ])->render();

        // Inisialisasi PDF
        $combinedContent = $page1 . $page2;

        // Inisialisasi PDF
        $pdf = PDF::loadHTML($combinedContent);
        return $pdf->download('myPDFfile.pdf');
    }

    public function printfileanalisa($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $sertification = Sertifikat::first();
        $data = [
            'pengajuan' => $pengajuan,
            'sertification' => $sertification,
            'title' => 'Sertifikat'
        ];
        $pdf = PDF::loadView('pages.pdfanalisa', $data);
        return $pdf->download('myPDFfile.pdf');
    }
}
