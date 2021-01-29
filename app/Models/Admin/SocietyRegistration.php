<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SocietyRegistration extends Model
{
	protected $fillable = [
		'name','slug','address','registration_no','registration_date','country_id','state_id','city_id',
	];

	/**
     * Get the country record associated with the country.
     */
	public function country()
	{
		return $this->belongsTo('App\Models\Admin\Country');
	}

    /**
     * Get the phone record associated with the user.
     */
    public function state()
    {
    	return $this->belongsTo('App\Models\Admin\State');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function city()
    {
    	return $this->belongsTo('App\Models\Admin\City');
    }
}