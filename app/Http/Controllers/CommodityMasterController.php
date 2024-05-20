<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Commodity;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommodityMasterController extends Controller
{
    public function index()
    {
        $commodity = Commodity::all();
        return view(
            'pages.commodity',
            [
                'user' => Auth::user(),
                'commodity' => $commodity
            ]
        );
    }

    public function create()
    {
        return view('pages.admin.create-commodity', [ 'user' => Auth::user(),]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'keterangan' => 'required',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        Commodity::create($request->all());

        return redirect()->route('commodity')->with('success', 'User has been created successfully');
    }

    public function edit($id)
    {
        $commodity = Commodity::find($id);
        $user = Auth::user();
        return view('pages.admin.edit-commodity', compact('commodity', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'keterangan' => 'required',
            // Sesuaikan validasi dengan kebutuhan Anda
        ]);

        $commodity = Commodity::find($id);
        $commodity->kode = $request->get('kode');
        $commodity->keterangan = $request->get('keterangan');
        // Tambahkan atribut lainnya sesuai kebutuhan

        $commodity->save();

        return redirect()->route('commodity')->with('success', 'Commodity updated successfully');
    }

    public function delete($id)
    {
        $commodity = Commodity::find($id);
        $commodity->delete();

        return redirect()->route('commodity')->with('success', 'Commodity deleted successfully');
    }

}
