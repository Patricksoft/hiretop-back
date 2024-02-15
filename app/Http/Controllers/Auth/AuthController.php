<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function index(){
        return response()->json(getApiConnectedUser(), Response::HTTP_OK);
    }

}
