<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class SizesController extends Controller
{
    // Size
   public function index($id=null){
       $sizes = DB::table('sizes')->get();
       $size = null;
       if($id!=null){
           $size = DB::table('sizes')->where('id',$id)->first();
       }
       $data['sizes'] = $sizes;
       $data['size'] = $size;

    return view('sizes.size',$data);
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
           DB::table('sizes')->where('id',$data['id'])->update($input);
       }
       else{
           DB::table('sizes')->insertGetid($input);
       }

       return redirect()->route('size');
   }
   public function delete($id){
       DB::table('sizes')->where('id',$id)->delete();
       return redirect('size')->with('status', 'Successfully Deleted.');
   }
}
