<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActionsController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|min:8|alpha_dash|confirmed',
        ], [
            'user.name.required' => 'Поле "Имя" обязательно для заполнения',
            'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
            'user.password.confirmed'=> 'Поле "Пароль" и "Повторите пароль" не совпадает',
        ]);

        $user = User::create($request -> input('user'));
        Auth::login($user);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user.email'=> 'required|email',
            'user.password'=> 'required|min:8|alpha_dash',
        ], [
            'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
        ]);
        if(Auth::attempt($request -> input('user'))) {
            return redirect('/');
        } else {
            return back() -> withErrors([
                'user.email' => 'Предоставленная почта или пароль не подходят'
            ]);
        }
    }

    public function load_music(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Необходима аутентификация');
        }

        $request->validate([
            'music.title' => 'required',
            'music.file' => 'required|file|mimes:mp3',
            'music.cover' => 'file|mimes:jpeg,png',
            'music.artist' => 'required',
            'music.year' => 'required|integer|min:1900|max:2024',
        ], [
            // 'music.title.required' => 'Поле "Название" обязательно для заполнения',
            'music.file.required' => 'Поле "Файл" обязательно для заполнения',
            'music.file.file' => 'Поле "Файл" должно быть файлом',
            'music.file.mimes' => 'Поле "Файл" должно быть файлом с расширением mp3',
            // 'music.cover.file' => 'Поле "Обложка" должно быть файлом',
            // 'music.cover.mimes' => 'Поле "Обложка" должно быть файлом с расширением jpeg или png',
            // 'music.author.required' => 'Поле "Автор" обязательно для заполнения',
            // 'music.year.required' => 'Поле "Год" обязательно для заполнения',
            // 'music.year.integer' => 'Поле "Год" должно быть числом',
            // 'music.year.min' => 'Поле "Год" должно быть не менее, чем 1900',
            // 'music.year.max' => 'Поле "Год" должно быть не более, чем 2024',
        ]);

        // Сохранение файла музыки
        if ($request->hasFile('music.file')) {
            $musicFilePath = $request->file('music.file')->store('music_files', 'public');
        }

        // Сохранение файла обложки
        if ($request->hasFile('music.cover')) {
            $coverFilePath = $request->file('music.cover')->store('cover_images', 'public');
        }

        $music = new Music;
        $music->fill($request->input('music'));
        $music->user_id = Auth::id();
        $music->file = $musicFilePath ?? null;
        $music->cover = $coverFilePath ?? null;
        $music->save();

    return redirect('/');
    }

    public function show(int $user_id)
    {
        $user = User::find($user_id);
        $music = Music::where('user_id', $user_id)->get();
        return view('user.show', ['user' => $user, 'music' => $music]);
    }

    public function profile(int $user_id)
    {
        $user = User::find($user_id);
        $music = Music::where('user_id', $user_id)->get();
        return view('user.profile', ['user' => $user, 'music' => $music]);
    }

    public function set_like(Request $request, $musicId)
    {
        $like = new Likes();
        $like->user_id = auth()->id();
        $like->music_id = $musicId;
        $like->save();

        return back();
    }

    public function destroy_like($musicId)
{
    $like = Likes::where('music_id', $musicId)->where('user_id', auth()->id())->first();
    if ($like) {
        $like->delete();
    }

    return back();
}
}
