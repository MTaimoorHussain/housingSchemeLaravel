<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    protected $fillable = [
    	'allotment_no','membership_no','member_name','member_cnic_no','plot_type_id','plot_category_id','block_no','plot_no','plot_area','cost_of_land','no_of_shares','status'
    ];
}
