<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Size extends Model
{
    protected $table = 'sizes';

    public function getSizeName($size)
    {
        $size = json_decode($size);
        $nameArr = array();
        foreach ($size as $k => $v) {
            $nameArr[] = DB::table('sizes')->where('id', $v)->first()->name;
        }
        //$nameArr = implode('->',$nameArr);
        //dd($nameArr);
        return $nameArr;
    }
}
