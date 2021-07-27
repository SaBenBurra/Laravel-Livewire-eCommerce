<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(20);
        return [
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 5, 2000),
            'slug' => SEO($name),
            'serial_number' => generateSerialNumber(),
            'stock' => $this->faker->numberBetween(5,500),
            'description' => $this->faker->text(600),
            'rating_average' => $this->faker->randomFloat(2,0,5),
        ];
    }
}
