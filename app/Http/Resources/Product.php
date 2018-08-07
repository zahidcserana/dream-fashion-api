<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'description' => $this->description,
          'category_id' => $this->category_id,
          'sub_category_id' => $this->sub_category_id,
          'sub_sub_category_id' => $this->sub_sub_category_id,
          'brand_id' => $this->brand_id,
          'price' => $this->price,
          'color' => $this->color,
          'size' => $this->size,
          'image_id' => $this->image_id,
          'status' => $this->status,
        ];
        //return parent::toArray($request);
    }
    public function with($request){
        return [
          'version' => '1.0.0',
          'author' => 'dream-soft'
        ];
    }
}
