<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = 'medicines';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'name',
        'dosage_form',
        'dosage_strength',
        'expiry_date',
        'quantity_in_stock',
    ];
}
