<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use DB;
use Validator;

class BrandController extends Controller
{
    public function index($id=null){
        $brands = DB::table('brands')->get();
        $brand = null;
        if($id!=null){
            $brand = DB::table('brands')->where('id',$id)->first();
        }
        $data['brands'] = $brands;
        $data['brand'] = $brand;

        return view('brands.brand',$data);
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
            'name' => $data['name']
        );
        if($data['id']!=null){
            DB::table('brands')->where('id',$data['id'])->update($input);
        }
        else{
            DB::table('brands')->insertGetid($input);
        }
        return redirect()->route('brand');
    }
    public function delete($id){
        DB::table('brands')->where('id',$id)->delete();
        return redirect('brand')->with('status', 'Successfully Deleted.');
    }
}
