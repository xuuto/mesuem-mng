<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name' => $this->faker->name,
            'address' => $this->faker->address,
            'city_id' => City::factory(),
            'user_id' => User::factory(),
        ];
    }
}
