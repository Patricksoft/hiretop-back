<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplySearchController extends Controller
{
    use OfferTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->indexOffer($request),Response::HTTP_OK);

    }


}
