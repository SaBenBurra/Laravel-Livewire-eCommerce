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

    public function generateSerialNumber()
    {
        $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $serialNumber = substr(str_shuffle($chars), 0, 8);

        $this->serial_number = $serialNumber;
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('place_number');
    }
}
