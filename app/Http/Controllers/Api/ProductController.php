<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\Api\ResponseController as ResponseController;
use Validator;

class ProductController extends ResponseController
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      //
      $products = Product::all();
      $productResources = ProductResource::collection($products);
      return $this->sendResponse($productResources, 'Products retrieved successfully');

   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {

   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $input = $request->all();

      $validator = Validator::make($input, [
        'name' => 'required',
        'detail' => 'required'
      ]);

      if ($validator->fails()) {
         return $this->sendError('Validation Error.', $validator->errors());
      }
      $product = Product::create($input);

      if ($product) {
         return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
      } else {
         return $this->sendError('Product not Created.', ['error' => 'Unauthorised']);
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $product = Product::find($id);
      if (is_null($product)) {
         return $this->sendError('Product not found.');
      }
      return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */

   public function update(Request $request, Product $product)
   {
      $input = $request->all();
      $validator = Validator::make($input, [
        'name' => 'required',
        'detail' => 'required'
      ]);

      if ($validator->fails()) {
         return $this->sendError('Validation Error.', $validator->errors());
      }

      $product->name = $input['name'];
      $product->detail = $input['detail'];
      $product->save();

      return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $request, Product $product)
   {
      $product->delete();
      return $this->sendResponse([], 'Product deleted successfully.');
   }
}
