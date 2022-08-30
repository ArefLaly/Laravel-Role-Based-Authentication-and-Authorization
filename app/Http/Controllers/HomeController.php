<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view("home");
        }
        return $this->welcome();
    }

    public function welcome()
    {
        return view("welcome");
    }
}
