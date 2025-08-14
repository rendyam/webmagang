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
        'name',
        'email',
        'phone',
        'spesialitation',
        'levels',
        'school',
        'start_date',
        'end_date',
        'jurusan',
        'path_submission_letter',
        'path_cv',
        'm_status_tabs_id',
        'path_photo',
    ];


    public function lasted()
    {
        return $this->hasOne(TRequestApproveTabs::class, 't_request_tabs_id', 'id')->where('m_status_tabs_id', 5)->orWhere('m_status_tabs_id', 6);
    }

    public function status()
    {
        return $this->hasOne(MStatusTabs::class, 'id', 'm_status_tabs_id');
    }

    public function requested()
    {
        return $this->hasMany(TRequestApproveTabs::class, 't_request_tabs_id', 'id');
    }
}
