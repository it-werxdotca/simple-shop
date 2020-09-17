<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $data = [
            "name" => implode(" ",$this->faker->words(3)),
            "price" => $this->faker->randomFloat(2,10,300),
            "discountPrice" => 0,
            "discount" => $this->faker->boolean(),
            "slug" => $this->faker->slug(),
            "freeShipping" => $this->faker->boolean(),
            "image" => $this->faker->imageUrl(),
            "status" => $this->faker->randomElement(["In stock","Preorder","Order"])
        ];

        $data["discountPrice"] = $this->faker->randomFloat(2,5,$data["price"]);

        return $data;
    }
}
