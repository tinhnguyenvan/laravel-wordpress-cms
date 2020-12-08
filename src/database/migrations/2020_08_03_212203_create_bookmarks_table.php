<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_bookmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type');
            $table->integer('model_id');
            $table->bigInteger('member_id')->default(0);
            $table->bigInteger('user_id')->default(0);
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
        Schema::dropIfExists('web_bookmarks');
    }
}
