<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('states')->delete();
       $states = array(
           array('name' => 'Sindh', 'country_id' => 92),
           array('name' => 'Punjab', 'country_id' => 92),
           array('name' => 'Northern Areas', 'country_id' => 92),
           array('name' => 'North-West Frontier', 'country_id' => 92),
           array('name' => 'Federally administered Tribal ', 'country_id' => 92),
           array('name' => 'Federal Capital Area', 'country_id' => 92),
           array('name' => 'Balochistan', 'country_id' => 92)
       );
       DB::table('states')->insert($states);
   }
}