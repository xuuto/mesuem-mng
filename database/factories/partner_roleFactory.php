<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Partner;
use App\Models\partner_role;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class partner_roleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = partner_role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gallery_id' => Gallery::factory(),
            'partner_id' => Partner::factory(),
            'role_id' => Role::factory(),
            'role_start' => $this->faker->date('Y-m-d'),
            // 'role_end_date' => $this->faker->date('y-m-d')
        ];
    }
}
