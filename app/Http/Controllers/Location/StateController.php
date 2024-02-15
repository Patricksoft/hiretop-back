<?php

namespace App\Http\Controllers\Location;

use App\Traits\LocationTrait;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Location\StoreStateRequest;
use App\Http\Requests\Location\UpdateStateRequest;

class StateController extends Controller
{
    use LocationTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index($country_id){
        return response()->json($this->getCountryState($country_id), Response::HTTP_OK);
    }

    public function listStates(){
        return response()->json($this->getAllStates(), Response::HTTP_OK);
    }

}
