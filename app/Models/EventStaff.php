<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStaff extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'event_id', 'staff_role_id', 'startDate', 'endDate'];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

     public function staff_role()
     {
         return $this->belongsTo(StaffRole::class);
     }

//    public function staff()
//    {
//        return $this->hasOneThrough(Staff::class, StaffRole::class, 'staff_id', 'id');
//    }
}
