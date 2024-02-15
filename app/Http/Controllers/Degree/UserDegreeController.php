<?php

namespace App\Http\Controllers\Degree;

use App\Http\Controllers\Controller;
use App\Http\Requests\Degree\UserDegreeStoreRequest;
use App\Http\Requests\Identity\IdentityStoreRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\UserDegree;
use App\Traits\DegreeTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDegreeController extends Controller
{
    use DegreeTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(){
        return response()->json($this->indexUserDegree(getApiConnectedUser()->id),Response::HTTP_OK);
    }

    public function store(UserDegreeStoreRequest $request)
    {
        return response()->json($this->saveUserDegree($request),Response::HTTP_OK);
    }

    public function destroy($id){
        return UserDegree::findOrFail($id)->delete();
    }

}
