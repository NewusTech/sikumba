<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {

        $attributes = request()->validate([
            'fullname' => 'required|max:255|min:2',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/.+\..+/', explode('@', $value)[1])) {
                        $fail('The '.$attribute.' must contain a valid domain.');
                    }
                },
            ],
            'password' => 'required|min:5|max:255',
        ]);

        // Hash password menggunakan bcrypt
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);
        $user->roles()->attach(2);
        if (Session::has('status')) {
            $status = Session::get('status');
        } else {
            $status = null;
        }

        // auth()->login($user);

        return redirect()->back()->with('status', 'Please wait verification from the admin!');
    }
}
