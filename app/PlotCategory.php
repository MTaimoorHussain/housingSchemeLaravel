<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlotCategory extends Model
{
    protected $fillable = [
        'plotTypeCat','CatName','catSize','catUnits','NoOfPlots','shares'
 ];
}
