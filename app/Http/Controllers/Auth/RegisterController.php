<?php

namespace app\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserStoreRequest;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    use UserTrait;


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterUserStoreRequest $request)
    {
        return response()->json($this->registerUser($request),Response::HTTP_OK);
    }

}
