<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'legal_name',
        'with_vat',
        'inn',
        'kpp',
        'ogrn',
        'okpo',
        'legal_address',
        'actual_address',
        'actual_address_same',
        'bank_name',
        'account_number',
        'bik',
        'correspondent_account',
        'director',
        'phone',
        'manager'
    ];
}
