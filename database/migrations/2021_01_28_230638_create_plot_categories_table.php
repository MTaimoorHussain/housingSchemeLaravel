<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plot_type_id');
            $table->string('name');
            $table->string('area');
            $table->integer('no_of_plots')->default(0);
            $table->integer('remaining_plots')->default(0);
            $table->integer('alloted_plots')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plot_categories');
    }
}
