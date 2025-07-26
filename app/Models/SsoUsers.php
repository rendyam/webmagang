<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SsoUsers extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'sso';
    protected $guard = 'admin';
    protected $table = 'users';
    
}
