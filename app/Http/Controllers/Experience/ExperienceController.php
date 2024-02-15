<?php

namespace App\Http\Controllers\Experience;

use App\Http\Controllers\Controller;
use App\Http\Requests\Experience\ExperienceStoreRequest;
use App\Models\Experience;
use App\Models\UserDegree;
use App\Traits\ExperienceTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController extends Controller
{
    use ExperienceTrait;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->indexExp(getApiConnectedUser()->id),Response::HTTP_OK);
    }


    /***
     * @param ExperienceStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ExperienceStoreRequest $request)
    {
        return response()->json($this->saveExp($request),Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Experience::findOrFail($id)->delete();
    }
}
