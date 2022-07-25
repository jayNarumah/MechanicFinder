<?php

namespace App\Http\Controllers;

use App\Models\Fedback;
use App\Http\Requests\StoreFedbackRequest;
use App\Http\Requests\UpdateFedbackRequest;

class FedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreFedbackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFedbackRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fedback  $fedback
     * @return \Illuminate\Http\Response
     */
    public function show(Fedback $fedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fedback  $fedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Fedback $fedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFedbackRequest  $request
     * @param  \App\Models\Fedback  $fedback
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFedbackRequest $request, Fedback $fedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fedback  $fedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fedback $fedback)
    {
        //
    }
}
