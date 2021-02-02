<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PlotCategory extends Model
{
	protected $fillable = [
		'plot_type_id','name','area','no_of_plots','remaining_plots','alloted_plots'
	];

	/**
     * Get the country record associated with the country.
     */
	public function plot_type_name()
	{
		return $this->belongsTo('App\Models\Admin\PlotType','plot_type_id','id');
	}
}