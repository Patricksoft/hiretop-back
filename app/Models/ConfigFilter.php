<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigFilter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'regions' => 'array',
        'sectors' => 'array',
        'type_contracts' => 'array',
        'type_location' => 'array',
        'languages' => 'array',
    ];
}
