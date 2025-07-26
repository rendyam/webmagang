<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRequestTabs extends Model
{
    use HasFactory;
    protected $table = 't_request_tabs';
    protected $fillable = [
        'users_tabs_id',
        'nim',
        'phone',
        'spesialitation',
        'levels',
        'school',
        'start_date',
        'end_date',
        'path_submission_letter',
        'path_cv',
        'path_photo',
    ];
}
