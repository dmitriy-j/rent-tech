<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'tenant_id',
        'equipment_id',
        'start_date',
        'end_date',
        'total_price',
        'status'
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}

