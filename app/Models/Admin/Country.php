<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	public function country()
	{
		return $this->hasOne('App\Models\Admin\SocietyRegistration');
	}
}