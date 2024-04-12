<?php

namespace App\Http\Controllers;

use App\Http\Requests\product_category\StoreProduct_categoryRequest;
use App\Http\Requests\product_category\UpdateProduct_categoryRequest;
use App\Models\Product_category;

class ProductCategoryController extends Controller
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
     * @param  \App\Http\Requests\product_category\StoreProduct_categoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct_categoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function show(Product_category $product_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_category $product_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\product_category\UpdateProduct_categoryRequest  $request
     * @param  \App\Models\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct_categoryRequest $request, Product_category $product_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_category $product_category)
    {
        //
    }
}
