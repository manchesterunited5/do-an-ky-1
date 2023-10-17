<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->string('image_contract')->nullable();
            $table->date('signing_date')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('contract_type_id')->nullable();
//            $table->foreign('contract_type_id')->references('id')->on('contract_type')->nullable();
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
        Schema::dropIfExists('onsite_contract');
    }
}
