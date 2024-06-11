<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'music_id',
    ];

    public function likes()
{
    return $this->hasMany(Likes::class);
}
}


