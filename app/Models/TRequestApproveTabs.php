<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRequestApproveTabs extends Model
{
    use HasFactory;
    protected $table = 't_request_approve_tabs';
    protected $fillable = [
        't_request_tabs_id',
        'sso_access_id',
        'm_status_tabs_id',
        'notes',
    ];
}
