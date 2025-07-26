<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SsoPosition extends Model
{
    use HasFactory;
    protected $connection = 'sso';
    protected $table = 'positions';
}
