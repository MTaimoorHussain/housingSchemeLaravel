<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	public function state()
	{
		return $this->hasOne('App\Models\Admin\SocietyRegistration');
	}
}