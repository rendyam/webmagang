<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SsoAccess extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'sso_access';
    protected $connection = 'mysql';

    public function position_user()
    {
        return $this->hasOne(SsoPositionUsers::class, 'id', 'users_position_id');
    }

    public function user()
    {
        return $this->hasOne(SsoUsers::class, 'id', 'users_id');
    }
}
