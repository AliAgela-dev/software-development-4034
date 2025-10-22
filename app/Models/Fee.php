<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'schoolID',
        'gradeID',
        'amount',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'schoolID');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'gradeID');
    }
}
