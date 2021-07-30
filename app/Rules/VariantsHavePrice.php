<?php

namespace App\Rules;

use App\Models\ProductVariant;
use Illuminate\Contracts\Validation\Rule;

class VariantsHavePrice implements Rule
{
    private $product;

    public function __construct($product)
    {
       $this->product = $product;
    }

    public function passes($attribute, $value)
    {
        if($this->product->price != $value) {
            return !ProductVariant::where('product_id', $this->product->id)
                ->where('is_price_using', 1)
                ->exists();
        }
        return true;
    }

    public function message()
    {
        return 'The price of a variant of this product is used.';
    }
}
