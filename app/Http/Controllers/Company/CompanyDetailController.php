<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyDetailController extends Controller
{
    use CompanyTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->indexCompanyDetail(), Response::HTTP_OK);
    }

    /***
     * @param CompanyStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json($this->saveCompanyDetail($request), Response::HTTP_OK);
    }
}
