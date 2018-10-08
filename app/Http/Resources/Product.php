<?php

namespace App\Http\Resources;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Image;
use App\Model\Status;
use App\Model\SubCategory;
use App\Model\SubSubCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $colorObj = new Color();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => Category::find($this->category_id),
            'sub_category_id' => SubCategory::find($this->sub_category_id),
            'sub_sub_category_id' => SubSubCategory::find($this->sub_sub_category_id),
            'brand_id' => Brand::find($this->brand_id),
            'price' => $this->price,
            'color' => empty($this->color) == true?'':$colorObj->getColorName($this->color),
            //'color' => Color::where('id', $this->color)->get(),
            'size' => $this->size,
            'image' => Image::find($this->image_id),
            'status' => Status::find($this->status),
        ];
        //return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author' => 'dream-soft'
        ];
    }
}
