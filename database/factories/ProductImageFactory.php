<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

    /**
     * Define the model's default state.
     *
     * @return array           
     */
    public function definition()
    {
        return [
            'img'        => $this->faker->imageUrl(500, 800 , 'cats'),/*цветные заглушки с текстом "cats"*/
            'product_id' => $this->faker->numberBetween($min = 1, $max = 10000),//какие то продукты останутся без картинки т.к не используется unique
        ];
    }
}
