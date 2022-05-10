<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partner_role extends Model
{
    use HasFactory;

    protected $table = 'partner_roles';

    protected $dates = [
        'role_start',
        'role_end',
    ];


    protected $fillable = [
        'gallery_id', 'partner_id', 'role_id', 'role_start', 'role_end'
    ];

//     public function setRoleStarAttribute($value)
//     {
//
//         $this->attributes['role_start'] = Carbon::createFromFormat('d-m-Y', $value)->toDateString();
//         dd($this->attributes['role_start'], $value);
//     }

    public function setRoleEndAttribute($date)
    {

        $this->attributes['role_end'] = empty($date) ? null : Carbon::parse($date);
//        dd($this->attributes['role_end']);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
