<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SocietyRegistration extends Model
{
	protected $fillable = [
		'name','slug','address','registration_no','registration_date','country_id','state_id','city_id','total_society_plots','total_alloted_area_sq','total_alloted_area_acre'
	];

	/**
     * Get the country record associated with the country.
     */
	public function country()
	{
		return $this->belongsTo('App\Models\Admin\Country');
	}

    /**
     * Get the state record associated with the state.
     */
    public function state()
    {
    	return $this->belongsTo('App\Models\Admin\State');
    }

    /**
     * Get the city record associated with the city.
     */
    public function city()
    {
    	return $this->belongsTo('App\Models\Admin\City');
    }
}