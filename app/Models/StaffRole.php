<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;

    // protected $dateFormat = 'd/m/Y';

    //    protected $casts = [
    //        'role_start' => 'date:Y-m-d',
    //        // 'role_end' =>   'date:Y-m-d',
    //    ];

    protected $dates = [
        'role_start',
        'role_end'
    ];
    protected $table = 'staff_roles';


    protected $fillable = ['gallery_id', 'staff_id', 'role_id', 'role_start', 'role_end'];

    public function setRoleEndAttribute($date)
    {
        //    		$this->attributes['role_end'] = date('Y-m-d', strtotime($date));
        $this->attributes['role_end'] = empty($date) ? null : Carbon::parse($date);
    }



    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    //    public function event_staff()
    //    {
    //        $this->hasMany(EventStaff::class);
    //    }
}
