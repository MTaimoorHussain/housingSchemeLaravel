<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function city()
	{
		return $this->hasOne('App\Models\Admin\SocietyRegistration');
	}
}