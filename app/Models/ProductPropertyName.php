<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyName extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function values() {
        return $this->hasMany(ProductPropertyValue::class, 'property_name_id', 'id');
    }
}
