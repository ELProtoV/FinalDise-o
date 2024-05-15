<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'description', 'image', 'user_id', 'rating'];

    // Relación con el modelo User (usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
