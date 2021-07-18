<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductPropertyValueUnique implements Rule
{

    public $productPropertyNameId;

    public function __construct($productPropertyNameId)
    {
        $this->productPropertyNameId = $productPropertyNameId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        file_put_contents('sa.txt', $value);
        return DB::table('product_property_values')
            ->where('property_name_id', $this->productPropertyNameId)
            ->where('value', $value)
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
