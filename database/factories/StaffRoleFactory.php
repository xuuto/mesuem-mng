<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StaffRole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gallery_id' => Gallery::factory(),
            'staff_id' => Staff::factory(),
            'role_id' => Role::factory(),
            'role_start' => $this->faker->date('Y-m-d'),
            // 'role_end' => $this->faker->date('Y-m-d'),

        ];
    }
}
