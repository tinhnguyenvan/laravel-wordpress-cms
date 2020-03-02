<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categorys', function (Blueprint $table) {
            $table->smallInteger('level')->default(0)->after('slug');
        });

        Schema::table('post_categorys', function (Blueprint $table) {
            $table->smallInteger('level')->default(0)->after('slug');
        });

        Schema::table('navs', function (Blueprint $table) {
            $table->smallInteger('level')->default(0)->after('value');
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
