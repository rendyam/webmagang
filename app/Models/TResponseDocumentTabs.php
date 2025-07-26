<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TResponseDocumentTabs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't_response_document_tabs';
    protected $fillable = [
        't_request_approve_tabs',
        'path_document',
    ];
}
