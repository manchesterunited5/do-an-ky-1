<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_detail', function (Blueprint $table) {
            $table->id();
            $table->string('image_certificate')->nullable();
            $table->string('place_certificate')->nullable();
            $table->string('certificate_period')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('certificate_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
//            $table->foreign('certificate_id')->references('id')->on('certificate')->nullable();
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
        Schema::dropIfExists('certificate_detail');
    }
}
