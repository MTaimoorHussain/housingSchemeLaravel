<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = [
        'chargeName','chargeType','plotTypeName','chargeAmount'
    ];
}
