<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Model\Product;
use App\Model\Size;
use App\Model\Color;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\SubSubCategory;
use App\Model\Brand;

class ProductsController extends Controller
{
    public function categoryProducts($catId, $limit = 15, Request $request)
    {
        $data = $request->all();
        $page = 1;
        if (isset($data['page'])) {
            $page = $data['page'];
        }
        $colorObj = new Color();
        $products = DB::table('products')->where('category_id', $catId)->paginate($limit);
        $productCount = DB::table('products')->where('category_id', $catId)->get();
        foreach ($products as $product) {
            //$product->name = '<a href="/view-product/'.$product->id.'">'.$product->name.'</a>';
            $product->image = empty($product->image_id != null) == true ? 'default.gif' : Product::find($product->id)->image->large;
            $product->category = empty($product->category_id) == true ? '' : Product::find($product->id)->category->name;
            $product->color = empty($this->color) == true ? '' : $colorObj->getColorName($this->color);
        }
        $data['products'] = $products;
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['total'] = count($productCount);

        $from = ($page * $limit) - ($limit - 1);
        $to = (($page * $limit) > $data['total']) == true ? $data['total'] : ($page * $limit);

        $data['from'] = $from;
        $data['to'] = $to;


        return view('front.products.products', $data);
    }

    public function viewProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $images = DB::table('images')->select('large')->where('product_id', $id)->get();
        $product->image = empty($product->image_id != null) == true ? 'default.gif' : Product::find($product->id)->image->large;
        $colorObj = new Color();
        $product->color = empty($product->color) == true?[]:$colorObj->getColorName($product->color);
        $sizeObj = new Size();
        $product->size = empty($product->size) == true?[]:$sizeObj->getSizeName($product->size);

        $product->category_id = Category::find($product->category_id);
        $product->sub_category_id = SubCategory::find($product->sub_category_id);
        $product->sub_sub_category_id = SubSubCategory::find($product->sub_sub_category_id);
        $product->brand_id = Brand::find($product->brand_id);


        $data['product'] = $product;
        $data['images'] = $images;
        //dd($product);
        return view('front.products.view_product', $data);
    }
}
