<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\ApplyStoreRequest;
use App\Http\Requests\StoreDiscussionRequest;
use App\Traits\DiscussionTrait;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiscussionController extends Controller
{

    use DiscussionTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->indexDiscussion(),Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDiscussionRequest $request)
    {
        return response()->json($this->saveDiscussion($request),Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
