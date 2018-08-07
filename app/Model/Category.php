<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    public function SubCategory()
    {
        return $this->hasMany('App\Model\SubCategory');
    }
}
