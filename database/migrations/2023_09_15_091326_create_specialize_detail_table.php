<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialize_detail', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('specialize_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->timestamps();$table->softDeletes();
//            $table->foreign('specialize_id')->references('id')->on('specialize')->nullable();
//            $table->foreign('employee_id')->references('id')->on('employee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onsite_specialize_detail');
    }
}
