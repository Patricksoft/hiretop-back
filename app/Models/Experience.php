<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function region(){
        return $this->belongsTo(Country::class,"region_id");
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
