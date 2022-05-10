<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventStaff;
use App\Models\StaffRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'staff_role_id' => StaffRole::factory(),
            'startDate' => $this->faker->date('Y-m-d'),
            'endDate' => $this->faker->date('Y-m-d'),
        ];
    }
}
