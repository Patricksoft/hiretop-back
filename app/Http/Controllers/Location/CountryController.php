<?php

namespace App\Http\Controllers\Location;

use Illuminate\Http\Request;
use App\Traits\LocationTrait;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Location\StoreCountryRequest;
use App\Http\Requests\Location\UpdateCountryRequest;

class CountryController extends Controller
{
    use LocationTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request){
        return response()->json($this->getCountry($request), Response::HTTP_OK);
    }


}
