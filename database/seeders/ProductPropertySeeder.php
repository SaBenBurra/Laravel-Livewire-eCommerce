<?php

namespace Database\Seeders;

use App\Models\ProductProperty;
use App\Models\ProductPropertyName;
use App\Models\ProductPropertyValue;
use Illuminate\Database\Seeder;

class ProductPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            'color' => ['red', 'blue', 'yellow', 'brown', 'green', 'orange', 'white'],
            'body' => ['medium', 'small', 'large', 'xsmall', 'xlarge'],
            'screen' => ['5inch', '4inch', '3inch', '4.4inch']
        ];

        foreach ($properties as $propertyName => $propertyArray) {
            $propertyNameModel = ProductPropertyName::create(['name' => $propertyName]);
            foreach ($propertyArray as $property) {
                ProductPropertyValue::create([
                    'property_name_id' => $propertyNameModel->id,
                    'value' => $property
                ]);
            }
        }
    }
}
