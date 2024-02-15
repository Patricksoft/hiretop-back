<?php

namespace App\Http\Controllers\Apply;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\ApplyProcessRequest;
use App\Http\Requests\Offer\ApplyStoreRequest;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyProcessController extends Controller
{

    use OfferTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param ApplyProcessRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApplyProcessRequest $request)
    {
        return response()->json($this->applyProcess($request),Response::HTTP_OK);
    }
}
