<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $tracks = Music::where('title', 'like', "%{$query}%")->get();

        return response()->json($tracks);
    }
}
