<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Model\Product;

class ProductsController extends Controller
{
   public function products(){
       $brands = DB::table('brands')->get();
       $categories = DB::table('categories')->get();
       //$products = DB::table('products')->get();
       //$data['products'] = $products;
       $data['categories'] = $categories;
       $data['brands'] = $brands;

    return view('products.products',$data);
   }
   public function productList(){
//       $brands = DB::table('brands')->get();
//       $categories = DB::table('categories')->get();
       $products = DB::table('products')->get();
       foreach ($products as $product){
           $product->name = '<a href="/add-product/'.$product->id.'">'.$product->name.'</a>';
           $product->category = empty($product->category_id)==true?'':Product::find($product->id)->category->name;
           $pId = $product->id;
           $product->actions =  '
               <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
                   Action <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="/add-product/'.$pId.'">Edit</a></li>
                    <li><a href="/product-delete/'.$pId.'">Delete</a></li>
                  </ul>
                </div>
					';
       }
       $data['products'] = $products;
//       $data['categories'] = $categories;
//       $data['brands'] = $brands;

    echo json_encode($products);
   }

   public function addProduct($id=null){
       $product = null;
       $images = null;
       if($id!=null){
           $product = DB::table('products')->where('id',$id)->first();
           $images = DB::table('images')->where('product_id',$id)->get();
       }
       $categories = DB::table('categories')->get();
       $brands = DB::table('brands')->get();
       $subCategories = DB::table('sub_categories')->get();
       $subSubCategories = DB::table('sub_sub_categories')->get();
       $sizes = DB::table('sizes')->get();
       $colors = DB::table('colors')->get();
       $data = array(
         'product' => $product,
         'brands' => $brands,
         'sizes' => $sizes,
         'colors' => $colors,
         'categories' => $categories,
         'sub_categories' => $subCategories,
         'sub_sub_categories' => $subSubCategories,
         'images' => $images,
       );
    return view('products.add',$data);
   }
    public function add(Request $request){
        $data = $request->except('_token');

        $rules = [
            'name' => 'required|string|max:100',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        $input = array(
            'name' => $data['name'],
            'brand_id' => $data['brand_id'],
            'description' => strip_tags($data['description']),
            'color' => json_encode($data['color']),
            'size' => json_encode($data['size']),
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'sub_sub_category_id' => $data['sub_sub_category_id'],
        );
        if($data['id']!=null){
            DB::table('products')->where('id',$data['id'])->update($input);
        }
        else{
            DB::table('products')->insert($input);
        }

        return redirect()->route('products');
    }
    public function delete($id){
        DB::table('products')->where('id',$id)->delete();
        return redirect('products')->with('status', 'Successfully Deleted.');
    }

}
