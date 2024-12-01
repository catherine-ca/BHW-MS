<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = 
    [
        'firstname',
        'middlename',
        'lastname',
        'age',
        'sitio',
        'phone_number',
    ];
}
