<?php

namespace App\Http\Controllers;

use App\Models\AreaSpecialization;
use App\Http\Resources\AreaSpecializationResource;
use App\Http\Requests\StoreAreaSpecializationRequest;
use App\Http\Requests\UpdateAreaSpecializationRequest;

class AreaSpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $area_specialization = AreaSpecialization::all()->load('carProduct', 'specializationArea', 'user');
        return AreaSpecializationResource::collection($area_specialization,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAreaSpecializationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaSpecializationRequest $request)
    {
        $area_specialization = AreaSpecialization::create([
            'car_product_id' => $request->car_product_id,
            'specialization_area_id' => $request->specialization_area_id,
            'user_id' => $request->user_id,
        ]);

        return new AreaSpecializationResource($area_specialization, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Http\Response
     */
    public function show(AreaSpecialization $areaSpecialization)
    {
        return new AreaSpecializationResource($areaSpecialization->load('carProduct', 'specializationArea', 'user'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAreaSpecializationRequest  $request
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaSpecializationRequest $request, AreaSpecialization $areaSpecialization)
    {
        $areaSpecialization->user_id = $request->user_id;
        $areaSpecialization->car_product_id = $request->car_product_id;
        $areaSpecialization->specialization_area_id = $request->specialization_area_id;
        $areaSpecialization->save();

        return new AreaSpecializationResource($areaSpecialization, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaSpecialization  $areaSpecialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaSpecialization $areaSpecialization)
    {
        $areaSpecialization->delete();

        return new AreaSpecializationResource("Record was Successfully Deleted !!!", 200);
    }
}
