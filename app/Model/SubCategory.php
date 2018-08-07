<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_categories';
//    public function medicineType()
//    {
//        return $this->belongsTo('MedicineType', 'id');
//    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
}
