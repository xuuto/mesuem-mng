<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gallery_id' => Gallery::factory(),
            'url' => $this->faker->image('public/storage/gallery', 200, 200, null, false),
        ];
    }
}
