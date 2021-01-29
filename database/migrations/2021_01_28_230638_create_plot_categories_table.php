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
            $table->string('plotTypeCat');
            $table->string('CatName');
            $table->string('catSize');
            $table->string('catUnits');
            $table->bigInteger('NoOfPlots');
            $table->integer('shares')->default(1);            
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
