<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->string('background_url')->nullable()->after('logo_url');
            $table->string('hotel_link')->nullable()->after('user_count');
        });
    }

    public function down()
    {
        Schema::table('retrohotels', function (Blueprint $table) {
            $table->dropColumn('background_url');
            $table->dropColumn('hotel_link');
        });
    }
};

