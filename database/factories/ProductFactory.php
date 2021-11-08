<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>'iphone',
            'description'=>'lorem esum dolor sldo flodorar lamlamop danos',
            'price'=>111.1,
        ];
    }
}
