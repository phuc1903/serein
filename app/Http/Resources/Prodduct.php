<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Prodduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'ma_sp'=>$this->id,
            'ten_sp'=>$this->title,
            'image'=>$this->image,
            'price'=>$this->price,
            'sale'=>$this->sale,
            'description'=>$this->description,
            'detail'=>$this->detail,
            'status'=>$this->status,
            'category_id'=>$this->category_id,
            'ngay_tao'=>$this->created_at->format('d/m/Y'),
            'ngay_cap_nhat'=>$this->updated_at->format('d/m/Y'),
        ];
    }

    
}
