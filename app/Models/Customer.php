<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table = 'customers';
    // Fillible properties
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];
}
