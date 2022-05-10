<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'gallery_id'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function event_staff()
    {
        return $this->hasMany(EventStaff::class);
    }
}
