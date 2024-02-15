<?php

namespace App\Http\Controllers\Degree;

use App\Http\Controllers\Controller;
use App\Traits\DegreeTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DegreeController extends Controller
{
    use DegreeTrait;


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return response()->json($this->indexDegree(),Response::HTTP_OK);
    }
}
