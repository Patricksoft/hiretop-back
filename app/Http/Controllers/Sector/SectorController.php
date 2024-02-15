<?php

namespace App\Http\Controllers\Sector;

use App\Http\Controllers\Controller;
use App\Traits\SectorTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectorController extends Controller
{
    use SectorTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        return response()->json($this->indexSector(),Response::HTTP_OK);
    }
}
