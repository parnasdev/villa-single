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
        Schema::create('link_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id');
            $table->string('title');
            $table->text('icon')->nullable();
            $table->foreignId('parent')->nullable();
            $table->text('href')->nullable();
            $table->boolean('is_link')->nullable()->default(false);
            $table->text('image')->nullable();
            $table->integer('order_item');
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
        Schema::dropIfExists('link_contents');
    }
};
