<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ChargeType extends Model
{
	protected $fillable = [
		'chargeTypeName','description'
	];
}
