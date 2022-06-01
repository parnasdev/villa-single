<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residence_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residence_id');
            $table->text('url');
            $table->string('alt')->nullable();
            $table->tinyInteger('type')->default(1); // 1 -> thumbnail , 2-> gallery
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
        Schema::dropIfExists('residence_files');
    }
}
