<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenceReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residence_reserves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residence_id');
            $table->json('dates');
            $table->bigInteger('totalPrice');
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('family');
            $table->string('phone');
            $table->foreignId('status_id');
            $table->softDeletes();
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
        Schema::dropIfExists('residence_reserves');
    }
}
