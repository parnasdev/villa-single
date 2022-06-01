<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount');
            $table->string('resnumber');
            $table->timestamp('enter_port_at')->nullable();
            $table->timestamp('exit_port_at')->nullable();
            $table->json('details')->nullable();
            $table->foreignId('status_id');
            $table->string('transactiontable_type');
            $table->bigInteger('transactiontable_id');
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
        Schema::dropIfExists('transactions');
    }
};
