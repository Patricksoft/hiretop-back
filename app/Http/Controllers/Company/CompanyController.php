<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Identity\IdentityStoreRequest;
use App\Traits\CompanyTrait;
use App\Traits\IdentityTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    use CompanyTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return response()->json($this->indexCompany(getApiConnectedUser()->id),Response::HTTP_OK);
    }

    public function store(CompanyStoreRequest $request)
    {
        return response()->json($this->saveCompany($request),Response::HTTP_OK);
    }
}
