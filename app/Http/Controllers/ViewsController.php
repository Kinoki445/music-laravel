<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function index()
    {
        return view("index", ['tracks' => Music::all()]);
    }

    public function register()
    {
        return view("register");
    }

    public function login()
    {
        return view("login");
    }

    public function load_music()
    {
        return view("pages.music.load_music");
    }
}
