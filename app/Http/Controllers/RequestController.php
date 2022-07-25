<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use App\Http\Resources\RequestResource;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RequestResource::collection(Request::all()->load('carProduct', 'mechanic', 'user'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestRequest $request)
    {
        $request = Request::create([
            'user_id' => $request->user_id,
            'mechanic_id' => $request->mechanic_id,
            'car_product_id' => $request->car_product_id,
            'description' => $request->description,
            'request_date' => now(),
        ]);

        return new RequestResource($request->load('user', 'mechanic', 'carProduct'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return new RequestResource($request->load('user', 'mechanic', 'carProduct'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestRequest  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestRequest $request, Request $_request)
    {
        $request->user_id = $_request->user_id;
        $request->mechanic_id = $_request->mechanic_id;
        $request->car_product_id = $_request->car_product_id;
        $request->description = $_request->description;
        $request->save();

        return new RequestResource($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->delete();

        return new RequestResource('Request was Successfully Deleted !!!', 200);
    }
}
