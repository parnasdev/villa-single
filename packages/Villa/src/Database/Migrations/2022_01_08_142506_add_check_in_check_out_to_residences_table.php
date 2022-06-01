<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckInCheckOutToResidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residence_reserves', function (Blueprint $table) {
            $table->date('checkIn');
            $table->date('checkOut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residence_reserves', function (Blueprint $table) {
            $table->dropColumn('checkIn' , 'checkOut');
        });
    }
}
