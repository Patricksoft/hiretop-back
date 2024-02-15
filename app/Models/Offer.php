<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Offer extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    protected $casts = [
        'interval_salary' => 'array',
        'year_exp' => 'array',
        'languages' => 'array',
        'skills' => 'array',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('label')
            ->saveSlugsTo('slug');
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function apply(){
        return $this->hasOne(Apply::class);
    }

    public function applies(){
        return $this->hasMany(Apply::class);
    }

    public function offer_skills(){
        return $this->hasMany(OfferSkill::class);
    }


}
