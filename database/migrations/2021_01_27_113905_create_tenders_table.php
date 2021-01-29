<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenderName');
            $table->string('tenderDepartment');
            $table->string('tenderType');
            $table->string('tenderNotice');
            $table->string('city');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('amount');
            $table->string('date');
            $table->string('timeDuration');
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
        Schema::dropIfExists('tenders');
    }
}
