<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name()
    {
        return $this->hasOne(ProductPropertyName::class, 'id', 'property_name_id');
    }

    public function value()
    {
        return $this->hasOne(ProductPropertyValue::class, 'id', 'property_value_id');
    }
}
