<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'sitio', 
        'age', 
        'age_category', 
        'gender', 
        'height', 
        'weight', 
        'purpose', 
        'status'
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
