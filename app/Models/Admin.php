<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    // Fillible properties
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];
}
