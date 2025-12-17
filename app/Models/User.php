<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone_number',
        'gender',
        'address',
        'bio',
        'photo',
        'password',
        'role',
        'status',                    // tambahkan ini
        'email_verification_token'    // tambahkan ini
    ];

    protected $hidden = [
        'password',
    ];
}
