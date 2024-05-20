<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}", ['user' => Auth::user()]);
        }

        return abort(404);
    }
    
    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
