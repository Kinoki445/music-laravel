<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Playlist;
use App\Models\Playlist_music;
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

    public function create_playlist()
    {
        return view("pages.music.create_playlist", ['tracks' => Music::all()]);
    }

    public function show_playlist(Request $request){
        $playlists = Playlist::with('music')->get(); // Загружаем плейлисты с треками
        // Передаем все необходимые данные в представление одним массивом
        return view("pages.music.show_playlists", [
            'playlists' => $playlists, // Используем загруженные плейлисты с треками
            'playlists_name' => Playlist::all(), // Это может быть избыточно, если 'playlists' уже содержит всю необходимую информацию
            'tracks' => Music::all() // Возможно, это также избыточно, если треки уже загружены через отношение 'music'
        ]);
    }
}
