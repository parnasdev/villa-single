<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("residences", function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug');
            $table->foreignId('province_id');
            $table->foreignId('city_id');
            $table->boolean('residence_owner')->default(false)->nullable();
            $table->string('mobile')->nullable();

            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->json('coordinates')->nullable();
            $table->float('building_area')->nullable();
            $table->float('land_area')->nullable();
            $table->integer('max')->nullable();
            $table->integer('room_count')->nullable();

            $table->json('rules')->nullable();

            $table->json('specifications')->nullable();

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
        Schema::dropIfExists("residences");
    }
}
