<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PlotType extends Model
{
	protected $fillable = [
		'society_id','name','total_plots','remaining_plots','alloted_plots'
	];

	public function plot_type()
	{
		return $this->hasOne('App\Models\Admin\PlotCategory');
	} 
}
