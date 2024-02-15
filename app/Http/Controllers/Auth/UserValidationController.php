<?php

namespace app\Http\Controllers\Auth;

use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Auth\UserValidationRequest;

class UserValidationController extends Controller
{
    use UserTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserValidationRequest $request)
    {
        $user = $this->validationUser($request);
        return response()->json($user,$user!=null ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
