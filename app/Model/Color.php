<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Color extends Model
{
    protected $table = 'colors';

    public function getColorName($color)
    {
        $color = json_decode($color);
        $nameArr = array();
        foreach ($color as $k => $v) {
            $nameArr[] = DB::table('colors')->where('id', $v)->first()->name;
        }
        //$nameArr = implode('->',$nameArr);
        //dd($nameArr);
        return $nameArr;
    }
}
