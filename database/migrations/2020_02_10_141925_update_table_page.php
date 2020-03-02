<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->smallInteger('template_id')->nullable()->default(0)->after('id');
        });

        Schema::table('contact', function (Blueprint $table) {
            $table->string('request_title')->nullable()->default(0)->after('contact_form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('template_id');
        });

        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn('request_title');
        });
    }
}
