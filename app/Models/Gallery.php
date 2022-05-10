<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = ['name', 'address', 'city_id', 'user_id'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function halls()
    {
        return $this->hasMany(Hall::class);
    }

    public function StaffRole(): HasMany
    {
        return $this->hasMany(StaffRole::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
