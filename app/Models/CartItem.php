<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variants()
    {
        $variants = [];
        foreach (json_decode($this->variants) as $variantId) {
            array_push($variants, ProductVariant::find($variantId));
        }
        return $variants;
    }

    public function price()
    {
        foreach ($this->variants() as $variant) {
            if ($variant->is_price_using === 1) {
                return $variant->price;
            }
        }
        return $this->product->price;
    }
}
