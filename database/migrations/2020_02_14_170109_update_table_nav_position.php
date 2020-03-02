<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableNavPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nav_positions', function (Blueprint $table) {
            $table->string('theme', 50)->nullable()->default(0)->after('slug');

            $table->index('theme', 'theme');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->string('theme', 50)->nullable()->default(0)->after('type');

            $table->index('theme', 'theme');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
