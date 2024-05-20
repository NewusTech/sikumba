<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Survey;
use App\Exports\SurveyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Kalibrasi;

class SurveyController extends Controller
{
    public function index()
    {
        $survey = Survey::get();

        return view('pages.user.form-survey', [
            'survey' => $survey,
            'user' => Auth::user(),
        ]);
    }

    public function indexhome()
    {
        $survey = Survey::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.history-survey', [
            'user' => Auth::user(),
            'survey' => $survey
        ]);
    }

    public function indexsearch(Request $request)
    {
        $search = $request->input('query');
        $rating = $request->input('rating');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');

        $survey = Survey::query();

        if ($search) {
            $survey->where('name', 'like', "%{$search}%");
        }

        if ($rating) {
            $survey->where('rating', $rating);
        }

        if ($dateawal) {
            $survey->where('created_at', '>=', "{$dateawal}");
        }

        if ($dateakhir) {
            $survey->where('created_at', '<=', "{$dateakhir}");
        }

        $survey = $survey->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.history-survey-search', [
            'user' => Auth::user(),
            'search' => $search,
            'survey' => $survey,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'no_handphone' => 'required',
            'rating' => 'required',
        ], [
            // Tambahkan pesan kustom untuk setiap field yang wajib diisi
            'name.required' => 'Field nama harus diisi.',
            'no_handphone.required' => 'Field no handphone harus diisi.',
            'rating.required' => 'Field penilaian harus diisi.',
            // Tambahkan pesan kustom untuk field lainnya
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();

            $form = Survey::create([
                'name' => $request->input('name'),
                'no_handphone' => $request->input('no_handphone'),
                'rating' => $request->input('rating'),
                'comments' => $request->input('comments'),
                'userID' => Auth::user()->id,
            ]);

            $pengajuan = Pengajuan::findOrFail($request->pengajuan_id);
            $pengajuan->update([
                'done_survey' => 1
            ]);

            // $user->roles()->attach([$request->input('role')]); // Gunakan attach() untuk menambahkan role baru.


            DB::commit();

            return redirect()->route('report-user')->with('success', 'Survey has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store2(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'no_handphone' => 'required',
            'rating' => 'required',
        ], [
            // Tambahkan pesan kustom untuk setiap field yang wajib diisi
            'name.required' => 'Field nama harus diisi.',
            'no_handphone.required' => 'Field no handphone harus diisi.',
            'rating.required' => 'Field penilaian harus diisi.',
            // Tambahkan pesan kustom untuk field lainnya
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();

            $form = Survey::create([
                'name' => $request->input('name'),
                'no_handphone' => $request->input('no_handphone'),
                'rating' => $request->input('rating'),
                'comments' => $request->input('comments'),
                'userID' => Auth::user()->id,
            ]);

            $pengajuan = Kalibrasi::findOrFail($request->kalibrasi_id);
            $pengajuan->update([
                'done_survey' => 1
            ]);

            // $user->roles()->attach([$request->input('role')]); // Gunakan attach() untuk menambahkan role baru.


            DB::commit();

            return redirect()->route('report-kalibrasi-user')->with('success', 'Survey has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function indexKalibrasi()
    {
        $survey = Survey::get();

        return view('pages.user.form-survey', [
            'survey' => $survey,
            'user' => Auth::user(),
        ]);
    }

    public function storeKalibrasi(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'no_handphone' => 'required',
            'rating' => 'required',
        ], [
            // Tambahkan pesan kustom untuk setiap field yang wajib diisi
            'name.required' => 'Field nama harus diisi.',
            'no_handphone.required' => 'Field no handphone harus diisi.',
            'rating.required' => 'Field penilaian harus diisi.',
            // Tambahkan pesan kustom untuk field lainnya
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            DB::beginTransaction();

            $form = Survey::create([
                'name' => $request->input('name'),
                'no_handphone' => $request->input('no_handphone'),
                'rating' => $request->input('rating'),
                'comments' => $request->input('comments'),
                'userID' => Auth::user()->id,
            ]);

            // $user->roles()->attach([$request->input('role')]); // Gunakan attach() untuk menambahkan role baru.


            DB::commit();

            return redirect()->route('report-kalibrasi-user')->with('success', 'Survey has been created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function exportToExcel(Request $request)
    {
        $search = $request->input('searchh');
        $rating = $request->input('rating');
        $dateawal = $request->input('dateawal');
        $dateakhir = $request->input('dateakhir');
        $filename = 'survey' . date('Ymd_His') . '.xlsx';

        return Excel::download(new SurveyExport($search, $dateawal, $dateakhir, $rating), $filename);
    }

}
