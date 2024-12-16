<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRetroOfTheMonthToRetrohotelsTable extends Migration
{
    public function up()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->boolean('is_retro_of_the_month')->default(false);
        });
    }

    public function down()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->dropColumn('is_retro_of_the_month');
        });
    }
}
