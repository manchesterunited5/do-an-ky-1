<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->date('birthday')->unique();
            $table->string('hometown')->nullable();
            $table->string('current_address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('citizen_identification_number')->nullable();
            $table->string('avatar')->nullable();
            $table->string('front_citizen_identity')->nullable();
            $table->string('back_citizen_identity')->nullable();
            $table->string('health_image')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('password')->nullable();
            $table->string('username')->nullable();
            $table->boolean('status_account')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
//            $table->foreign('role_id')->references('id')->on('role')->nullable();
//            $table->foreign('contract_id')->references('id')->on('contract')->nullable();
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
        Schema::dropIfExists('employee');
    }
}
