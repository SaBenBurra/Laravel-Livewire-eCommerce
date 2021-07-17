<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public function setPlaceNumber($productId)
    {
        $this->place_number = ProductImage::where('product_id', $productId)->max('place_number') + 1;
    }

    public static function resetPlaceNumbers($productId)
    {
        ProductImage::where('product_id', $productId)->update(['place_number' => null]);
    }
}
