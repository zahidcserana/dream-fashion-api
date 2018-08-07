<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Model\Product;
use App\Http\Resources\Product as ProductResource;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

}
