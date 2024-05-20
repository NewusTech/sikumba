<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VerificationAccountController extends Controller
{
    public function index()
    {
        $no_verif = User::where('status', 0)->get();
        return view(
            'pages.admin.verification-account',
            [
                'user' => Auth::user(),
                'no_verif' => $no_verif
            ]
        );
    }

    public function approve($id)
    {
        $users = User::find($id);

        if ($users) {
            $users->increment('status');
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status.');
    }

    // public function approve(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->verified = true;
    //     $user->save();

    //     // Tambahkan notifikasi atau email ke pengguna yang akunnya telah diverifikasi

    //     return redirect()->route('pages.admin.verification-account')->with('success', 'User account has been approved.');
    // }
}
