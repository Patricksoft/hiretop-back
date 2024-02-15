<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessApply extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'selection_interview_planning' => 'array',
        'competency_interview_planning' => 'array',
    ];
}
