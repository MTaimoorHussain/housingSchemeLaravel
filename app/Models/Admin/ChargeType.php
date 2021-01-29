<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChargeType extends Model
{
    protected $fillable = [
        'chargeTypeName','description'
    ];
}
