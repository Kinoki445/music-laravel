<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Likes; // Add this import statement

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'genre',
        'year',
        'cover',
        'file',
        'user_id',
    ];

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_music');
    }
}
