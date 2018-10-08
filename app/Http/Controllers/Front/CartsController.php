<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Model\Product;
use Illuminate\Http\Request;
use Validator;
use DB;

class CartsController extends Controller
{
    public function addToCart(Request $request)
    {
        $data = $request->except('_token');
        if ($request->session()->get('cart_id')) {
            $cartId = $request->session()->get('cart_id');
        } else {
            $cartInput = array(
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $cartId = DB::table('carts')->insertGetid($cartInput);
            $request->session()->put('cart_id',$cartId);
        }
        $input = array(
            'cart_id' => $cartId,
            'product_id' => $data['product_id']
        );

        DB::table('cart_items')->insert($input);

        echo json_encode(array('success' => true));
    }

    public function viewCart(Request $request){
        $cartItems = array();
        if ($request->session()->get('cart_id')) {
            $cartId = $request->session()->get('cart_id');
            $cartItems = DB::table('cart_items')->where('cart_id',$cartId)->get();
        }
        foreach ($cartItems as $cartItem){
            $cartItem->product = Product::find($cartItem->product_id);
            //$cartItem->image = Image::find($cartItem->product->image_id);
            $cartItem->image = empty($cartItem->product->image_id) == true ? 'default.gif' : Image::find($cartItem->product->image_id)->large;

        }
       // dd($cartItems);
        $data['items'] = $cartItems;
        return view('front.products.view_cart', $data);
    }
}
