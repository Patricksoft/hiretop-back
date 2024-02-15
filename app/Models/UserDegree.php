<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDegree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function degree(){
        return $this->belongsTo(Degree::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }


}
