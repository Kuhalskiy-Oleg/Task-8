<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $title = $this->faker->unique()->randomElement($array = array ('Telephone','Laptop','Сomputer')); 
        return [
            'title'       => $title,
            'description' => $this->faker->text($maxNbChars = 1000),
            'announcement'=> $this->faker->text($maxNbChars = 300),
            'img'         => $this->faker->imageUrl(500, 800 , 'cats'),/*цветные заглушки с текстом "cats"*/
            'img_label'   => $this->faker->imageUrl(1000, 600, '', false, '', false),
            'slug'        => Str::slug($title),
        ];
    }
}
