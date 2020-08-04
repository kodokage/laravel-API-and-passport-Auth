<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Product;
use App\Http\Resources\ProductResource;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        //return ProductResource::collection($products);
        return $this->sendResponse(ProductResource::Collection($products), 'Products Retrieved');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->details = $request->input('details');
        
        $product->save();
        //return new ProductResource($product);
        return $this->sendResponse(new ProductResource($product), 'Product Added');
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

        $this->validate($request,[
            'name' => 'required',
            'details' => 'required'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->details = $request->input('details');
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $this->sendResponse(new ProductResource($product), 'Product deleted');

    }
}
