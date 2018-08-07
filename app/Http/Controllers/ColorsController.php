<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

class ColorsController extends Controller
{
    // Color
   public function index($id=null){
       $colors = DB::table('colors')->get();
       $color = null;
       if($id!=null){
           $color = DB::table('colors')->where('id',$id)->first();
       }
       $data['colors'] = $colors;
       $data['color'] = $color;

    return view('colors.color',$data);
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
           DB::table('colors')->where('id',$data['id'])->update($input);
       }
       else{
           DB::table('colors')->insertGetid($input);
       }

       return redirect()->route('color');
   }
   public function delete($id){
       DB::table('colors')->where('id',$id)->delete();
       return redirect('color')->with('status', 'Successfully Deleted.');
   }
}
