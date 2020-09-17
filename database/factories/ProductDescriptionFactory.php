<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductDescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "description" => implode("\n",$this->faker->paragraphs(4)),
        ];
    }
}
