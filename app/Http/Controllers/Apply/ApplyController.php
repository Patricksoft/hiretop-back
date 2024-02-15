<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\ApplyStoreRequest;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyController extends Controller
{
    use OfferTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApplyStoreRequest $request)
    {
        return response()->json($this->applyOffer($request),Response::HTTP_OK);
    }

}
