<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role_name', 'is_staff_role', 'is_partner_role'];
    //      protected $guarded = [];

    protected $casts = [
        'is_staff_role' => 'boolean',
        'is_partner_role' => 'boolean'
    ];

    public function staffRoles()
    {
        return $this->hasMany(StaffRole::class);
    }

    // public function staffs()
    // {
    //     return $this->belongsToMany(Staff::class, 'staff_roles', 'role_id', 'staff_id')
    //         ->withPivot('gallery', 'role_start_date', 'role_end_date')->withTimestamps();
    // }

    public function partner_roles()
    {
        return $this->hasMany(partner_role::class);
    }
}
