<?php

namespace App\Http\Controllers;

use App\Models\CarProduct;
use App\Http\Requests\StoreCarProductRequest;
use App\Http\Requests\UpdateCarProductRequest;
use App\Http\Resources\CarProductResource;

class CarProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarProductResource::collection(CarProduct::all(), 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarProductRequest $request)
    {
        $car_product = CarProduct::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return new CarProductResource($car_product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarProduct  $carProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CarProduct $carProduct)
    {
        return new CarProductResource($carProduct, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarProduct  $carProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CarProduct $carProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarProductRequest  $request
     * @param  \App\Models\CarProduct  $carProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarProductRequest $request, CarProduct $carProduct)
    {
        $carProduct->name = $request->name;
        $carProduct->save();

        return new CarProductResource($carProduct, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarProduct  $carProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarProduct $carProduct)
    {
        $carProduct = $carProduct->delete();
    }
}
