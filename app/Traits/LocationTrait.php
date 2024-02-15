<?php

namespace App\Traits;


use App\Models\City;
use App\Models\State;
use App\Models\Airport;
use App\Models\Country;
use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;


trait LocationTrait
{




    // crud for country
    public function getCountry($request)
    {
        return Country::all();
    }

    public function getCountryState($id)
    {
        return State::where("country_id", $id)->with('country')->get();
    }



    // crud for State
    public function getAllStates()
    {
        return State::with( "city")->get();
    }

    // crud for City
    public function getStateCity($id)
    {
        return City::where("state_id", $id)->with('state')->get();
    }

    public function getAllCities()
    {
        return City::with("state")->orderByDesc('id')->get();
    }

}
