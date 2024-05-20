<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Models\Logo;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        $logo = Logo::first();
        return view('auth.login', [
            'logo' => $logo,
        ]);
    }

    public function login(Request $request)
    {
        // $user = Auth::user();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 1) {
                if ($user->roles->contains('name', 'Admin')) {
                    return redirect('user-management')->with('user', $user);
                } else if ($user->roles->contains('name', 'User')) {
                    return redirect('report-user')->with('user', $user);
                } else {
                    return redirect('history-pengajuan')->with('user', $user);
                }
            } else {
                Auth::logout(); // Logout pengguna yang belum diverifikasi
                return back()->withErrors([
                    'email' => 'Your account is not yet verified.',
                ]);
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
