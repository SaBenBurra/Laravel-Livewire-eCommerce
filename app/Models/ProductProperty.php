<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyName()
    {
        return $this->hasOne(ProductPropertyName::class, 'id', 'property_name_id');
    }

    public function propertyValue()
    {
        return $this->hasOne(ProductPropertyValue::class, 'id', 'property_value_id');
    }
}
