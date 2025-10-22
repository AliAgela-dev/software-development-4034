<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'schoolID',
        'userID',
        'rating',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'schoolID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
