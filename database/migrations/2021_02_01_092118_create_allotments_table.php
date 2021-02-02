<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('allotment_no')->unique();
            $table->string('membership_no')->unique();
            $table->string('member_name');
            $table->string('member_cnic_no')->unique();
            $table->integer('plot_type_id')->default(0);
            $table->integer('plot_category_id')->default(0);
            $table->integer('plot_no')->default(0);
            $table->integer('plot_area')->default(0);
            $table->integer('cost_of_land')->default(0);
            $table->integer('no_of_shares')->default(1);
            $table->enum('status',['allottee','cancelled'])->nullable();
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
        Schema::dropIfExists('allotments');
    }
}
