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
        Schema::create('post_files', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->boolean('private_path')->default(false);
            $table->tinyInteger('type');
            $table->bigInteger('post_fileable_id');
            $table->string('post_fileable_type');
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
        Schema::dropIfExists('post_files');
    }
};
