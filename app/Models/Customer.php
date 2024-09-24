<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // Fillible properties
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];
}
