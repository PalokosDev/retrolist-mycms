<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaintenanceModeToRetrohotelsTable extends Migration
{
    public function up()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->boolean('maintenance_mode')->default(false); // Neues Feld hinzufügen
        });
    }

    public function down()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->dropColumn('maintenance_mode');
        });
    }
}

