<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_history', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('classification_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
//            $table->foreign('classification_id')->references('id')->on('classification')->nullable();
//            $table->foreign('employee_id')->references('id')->on('employee')->nullable();
            $table->timestamps();$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classification_history');
    }
}
