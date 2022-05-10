<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name'];
    //        protected $guarded = [];

    public function staffRoles()
    {
        return $this->hasMany(StaffRole::class);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'staff_roles', 'staff_id', 'role_id')
    //         ->withPivot('gallery_id', 'role_start', 'role_end')->withTimestamps();
    // }

    //    public function eventstaff()
    //    {
    //        return $this->hasMany(EventStaff::class);
    //    }

    // public function eventStaffs()
    // {
    //     return $this->hasManyThrough()
    // }
}
