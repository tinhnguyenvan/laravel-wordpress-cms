<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePostTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'web_post_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('post_id')->unsigned();
                $table->string('locale')->index();
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->text('summary')->nullable();
                $table->text('detail')->nullable();
                $table->text('seo_title')->nullable();
                $table->text('seo_description')->nullable();

                $table->timestamps();
                $table->unique(['post_id', 'locale']);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_post_translations');
    }
}
