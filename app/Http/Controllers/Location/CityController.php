<?php

namespace App\Http\Controllers\Location;

use App\Traits\LocationTrait;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Location\StoreCityRequest;
use App\Http\Requests\Location\UpdateCityRequest;

class CityController extends Controller
{
    use LocationTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index($state_id){
        return response()->json($this->getStateCity($state_id), Response::HTTP_OK);
    }

    public function listCity(){
        return response()->json($this->getAllCities(), Response::HTTP_OK);
    }

}
