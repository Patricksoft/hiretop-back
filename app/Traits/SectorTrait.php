<?php

namespace App\Traits;

use App\Models\Degree;
use App\Models\Identity;
use App\Models\Sector;
use App\Models\User;
use App\Models\UserDegree;
use App\Notifications\AlertAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

trait SectorTrait
{
    public function indexSector(){
        return Sector::all();
    }

}
