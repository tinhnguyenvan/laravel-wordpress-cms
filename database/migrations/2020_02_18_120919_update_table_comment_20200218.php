<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableComment20200218 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('approved');
            $table->dropColumn('agent');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->smallInteger('status')->nullable()->default(0)->after('content');
            $table->string('agent', 255)->nullable()->default('')->after('content');
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
