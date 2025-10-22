<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    
    protected $fillable = [
        'name',
        'username',
        'phone_number',
        'password',
        'schoolID'
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'schoolID');
    }
}
