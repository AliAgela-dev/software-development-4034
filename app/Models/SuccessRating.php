<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessRating extends Model
{
    protected $fillable = [
        'schoolID',
        'gradeID',
        'total_students',
        'A',
        'B',
        'C',
        'D',
    ];


    protected $appends = [
        'success_rate',
    ];

    public function getSuccessRateAttribute(): float
    {
        $total_students = $this->total_students;
        if ($total_students === 0) {
            return 0;
        }

        $weighted_sum = ($this->A * 4) + ($this->B * 3) + ($this->C * 2) + ($this->D * 1);
        $max_score = $total_students * 4;

        return $max_score > 0 ? ($weighted_sum / $max_score) * 100 : 0;
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'schoolID');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'gradeID');
    }

};