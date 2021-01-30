<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
	protected $fillable = [
		'accountNumber','bankName','companyName',
	];
}
