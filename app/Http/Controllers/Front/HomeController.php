<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

class HomeController extends Controller
{
    public function home(){
        $brands = DB::table('brands')->get();
        $categories = DB::table('categories')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;

        return view('front.home',$data);
    }
}
