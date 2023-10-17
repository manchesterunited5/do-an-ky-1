<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvencementHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advancement_history', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
//            $table->foreign('position_id')->references('id')->on('position')->nullable();
//            $table->foreign('employee_id')->references('id')->on('employee')->nullable();
//            $table->foreign('department_id')->references('id')->on('department')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advencement_history');
    }
}
