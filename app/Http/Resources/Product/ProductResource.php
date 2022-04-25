<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'details'=>$this->details,
            'price'=>$this->price,
            'stock'=>$this->stock==0 ? 'out of stock':$this->stock,
            'discount'=>$this->discount,
            'total price'=>round((1-($this->discount/100))*$this->price,2),
            'star'=>$this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count()):'No Rating Yet',
            'href'=>[
                'reviews'=>route('reviews.index',$this->id),
            ]
        ];
    }
}
