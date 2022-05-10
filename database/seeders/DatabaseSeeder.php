<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventStaff;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\partner_role;
use App\Models\Role;
use App\Models\Staff;
use App\Models\StaffRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(SettingsTableSeeder::class);
        Gallery::factory(10)->create();
        //        Staff::factory()->has(Role::factory()->count(3))
        //            ->create();
        // Staff::factory()->count(4)->create();
        Role::factory()->count('4')->create();
        // StaffRole::factory()->count('10')->create();
        Partner::factory()->count(10)->create();
        partner_role::factory()->count(10)->create();
        Event::factory()->count(10)->create();
        EventStaff::factory()->count(10)->create();

        //        foreach (Staff::all() as $staff)
        //        {
        //            $roles = Role::factory()->count(4)->create()->pluck('id');
        //            foreach ($roles as $role) {
        //                $staff->roles()->attach($role);
        //            }
        //        }
    }
}
