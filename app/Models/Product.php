<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['serial_number', 'rating_average'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function setSerialNumber()
    {

        $this->serial_number = generateSerialNumber();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('place_number');
    }

    public function properties()
    {
        return $this->hasMany(ProductProperty::class);
    }
}
