<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $title = $this->faker->unique()->text($maxNbChars = 20);
        $new_price = $this->faker->randomElement($array = array (null,$this->faker->numberBetween($min = 1, $max = 100))); 
        return [

            'title'       => $title,
            'category_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'price'       => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000),
            'new_price'   => $new_price,
            'in_stock'    => $this->faker->boolean($chanceOfGettingTrue = 50),
            'description' => $this->faker->text($maxNbChars = 800),
            'announcement'=> $this->faker->text($maxNbChars = 300),
            'img_label'   => $this->faker->imageUrl(1000, 800, '', false, '', false),
            'slug'        => Str::slug($title),

        ];
    }
}
