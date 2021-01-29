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
    	DB::table('countries')->truncate();
    	$countries = array(
    		array(
    			'id' => 1,
    			'name' => 'Pakistan',
    			'slug' => 'PK' ,
    			'phone_code' => 92
    		)
    	);
    	DB::table('countries')->insert($countries);
    }
}
