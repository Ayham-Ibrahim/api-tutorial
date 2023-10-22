<?php

namespace App\Http\Controllers\API;

use App\Http\Traits;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ProductsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;

class ProductsController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $this->apiResponse(ProductsResource::collection($products),'ok',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'price' => ['required','integer'],
            'description' => ['required','string'],
            'category' => ['required','exists:categories,id'],
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $product = Product::create([
            'name'        => $request->name,
            'category_id' => $request->category,
            'price'       => $request->price,
            'desc'        => $request->description,
        ]);

        if($product){
            return $this->apiResponse(new ProductsResource($product),'the product added',200);
        }
        return $this->apiResponse(null,'the product not added',400);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->apiResponse(null,'the product not found',404);
        }
        return $this->apiResponse(new ProductsResource($product),'ok',200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->apiResponse(null,'the product not found',404);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'price' => ['required','integer'],
            'description' => ['required','string'],
            'category' => ['required','exists:categories,id'],
        ]);

        if($validator->fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $product->update([
            'name'        => $request->name,
            'category_id' => $request->category,
            'price'       => $request->price,
            'desc'        => $request->description,
        ]);

        if($product){
            return $this->apiResponse(new ProductsResource($product),'the product updated',200);
        }
        return $this->apiResponse(null,'the product not updated',400);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->apiResponse(null,'the product not found',404);
        }
        $product->delete($id);
        return $this->apiResponse("",'the product deleted',200);

    }
}

