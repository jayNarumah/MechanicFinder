<?php

namespace App\Http\Controllers;

use App\Models\SpecializationArea;
use App\Http\Requests\StoreSpecializationAreaRequest;
use App\Http\Requests\UpdateSpecializationAreaRequest;
use App\Http\Resources\SpecializationAreaResource;

class SpecializationAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpecializationAreaResource::collection(SpecializationArea::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpecializationAreaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecializationAreaRequest $request)
    {
        $area = SpecializationArea::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return new SpecializationAreaResource($area, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecializationArea  $specializationArea
     * @return \Illuminate\Http\Response
     */
    public function show(SpecializationArea $specializationArea)
    {
        return new SpecializationAreaResource($specializationArea, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecializationAreaRequest  $request
     * @param  \App\Models\SpecializationArea  $specializationArea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecializationAreaRequest $request, SpecializationArea $specializationArea)
    {
        $specializationArea->name = $request->name;
        $specializationArea->description = $request->description;
        $specializationArea->save();

        return new SpecializationAreaResource($specializationArea, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecializationArea  $specializationArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecializationArea $specializationArea)
    {
        $specializationArea->delete();

        return new SpecializationAreaResource('Record was Successfully Deleted !!!', 200);
    }
}
