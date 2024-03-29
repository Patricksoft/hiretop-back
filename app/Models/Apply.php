<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function process_apply(){
        return $this->hasOne(ProcessApply::class);
    }


}
