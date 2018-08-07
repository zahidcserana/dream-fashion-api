<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $table='sub_sub_categories';

    public function subCategory()
    {
        return $this->belongsTo('App\Model\SubCategory');
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
}
