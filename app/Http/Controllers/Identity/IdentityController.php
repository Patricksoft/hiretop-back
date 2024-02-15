<?php

namespace App\Http\Controllers\Identity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserValidationRequest;
use App\Http\Requests\Identity\IdentityStoreRequest;
use App\Traits\IdentityTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentityController extends Controller
{
    use IdentityTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return response()->json($this->indexIdentity(getApiConnectedUser()->id),Response::HTTP_OK);
    }

    public function store(IdentityStoreRequest $request)
    {
        return response()->json($this->saveIdentityTalent($request),Response::HTTP_OK);
    }
}
