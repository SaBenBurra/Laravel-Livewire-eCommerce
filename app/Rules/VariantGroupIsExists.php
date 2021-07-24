<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VariantGroupIsExists implements Rule
{
    public $productVariantGroups;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productVariantGroups)
    {
        $this->productVariantGroups = $productVariantGroups;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $variantsOfNewVariantGroup)
    {
        file_put_contents('sa.txt', print_r($variantsOfNewVariantGroup, true));
        return !in_array(reset($variantsOfNewVariantGroup)['property_name_id'], array_keys($this->productVariantGroups));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This variant group already created.';
    }
}
