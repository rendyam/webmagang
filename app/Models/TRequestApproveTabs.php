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
        'status_ref',
        'sso_access_id',
        'm_status_tabs_id',
        'notes',
    ];

    public function status()
    {
        return $this->hasOne(MStatusTabs::class, 'id', 'm_status_tabs_id');
    }

    public function sso_access()
    {
        return $this->hasOne(SsoAccess::class, 'id', 'sso_access_id');
    }

    public function doc()
    {
        return $this->hasOne(TResponseDocumentTabs::class, 't_request_approve_tabs', 'id');
    }
}
