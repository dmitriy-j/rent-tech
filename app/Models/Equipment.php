<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function activeRentals()
    {
        return $this->rentals()
            ->whereIn('status', ['pending', 'active']);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
