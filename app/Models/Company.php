<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function presentation(){
        return $this->hasOne(Presentation::class);
    }


}
