<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('countries')->delete();
    	$countries = [
    		[
    			'id' => 1,
    			'slug' => 'PK',
    			'name' => 'Pakistan',
    			'phone_code' => 92
    		]
    	];
    	DB::table('countries')->insert($countries);
    }
}
