<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $fillable = [
        'tenderName','tenderDepartment','tenderType','tenderNotice','city',
        'email','phoneNumber','amount','date','timeDuration'
    ];  
}
