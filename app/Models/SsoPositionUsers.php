<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SsoPositionUsers extends Model
{
    use HasFactory;
    protected $connection = 'sso';
    protected $table = 'position_users';

    public function position(){
        return $this->hasOne(SsoPosition::class,'id','position_id');
    }
}
