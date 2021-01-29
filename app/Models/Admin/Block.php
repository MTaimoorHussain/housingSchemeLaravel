<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	protected $fillable = [
		'blockName','description','plot_category'
	];
}
