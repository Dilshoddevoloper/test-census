<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationDenyReason extends Model
{
    protected $table = 'application_deny_reason';

    protected $guarded = ['id'];
    public $timestamps = false;
}
