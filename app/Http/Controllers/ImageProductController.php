<?php

namespace App\Http\Controllers;

use App\Models\Image_product;
use App\Http\Requests\StoreImage_productRequest;
use App\Http\Requests\UpdateImage_productRequest;

class ImageProductController extends Controller
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
     * @param  \App\Http\Requests\StoreImage_productRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImage_productRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image_product  $image_product
     * @return \Illuminate\Http\Response
     */
    public function show(Image_product $image_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image_product  $image_product
     * @return \Illuminate\Http\Response
     */
    public function edit(Image_product $image_product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImage_productRequest  $request
     * @param  \App\Models\Image_product  $image_product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImage_productRequest $request, Image_product $image_product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image_product  $image_product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image_product $image_product)
    {
        //
    }
}
