<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call([
            // AllBankSeeder::class,
            // ChargeTypeSeeder::class,
    		// CitiesTableSeeder::class,
    		// CountriesTableSeeder::class,
    		// StatesTableSeeder::class,
            // PlotCategoryFeeSeeder::class,
            // PlotTypeSeeder::class,
            // PlotCategoryFeeSeeder::class,
            // PlotCategorySeeder::class
            // RollTitleSeeder::class
    	]);
        // factory(App\Models\Admin\MemberShipFor::class,20)->create();
        // factory(App\Models\Admin\UnitInfo::class,12)->create();
    }
}
