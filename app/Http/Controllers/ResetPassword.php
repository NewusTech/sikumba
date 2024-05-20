<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    use Notifiable;

    // public function show()
    // {
    //     return view('auth.reset-password');
    // }

    public function routeNotificationForMail() {
        return request()->email;
    }

    // public function send(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => ['required', 'email'],
    //     ]);

    //     // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan kesalahan
    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     // Cari user berdasarkan alamat email
    //     $user = User::where('email', $request->input('email'))->first();

    //     // Jika user ditemukan, kirim email
    //     if ($user) {
    //         $this->notify(new ForgotPassword($user->id));
    //         return back()->with('success', 'An email has been sent to your email address');
    //     }

    //     // Jika user tidak ditemukan, kembali dengan pesan yang sesuai
    //     return back()->with('error', 'User with this email address does not exist');
    // }

    public function show() {

         return view('auth.forgot-password');

    }

    public function postForgotPassword(Request $request) {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function getResetPasswordToken($token) {

            return view('auth.reset-password', ['token' => $token]);

        }

    public function postResetPasswordToken(Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);

    }

}
