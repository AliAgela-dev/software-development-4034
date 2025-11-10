<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'userID',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
