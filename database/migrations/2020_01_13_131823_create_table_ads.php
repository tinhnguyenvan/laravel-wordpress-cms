<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('position')->default('')->nullable();
            $table->string('title')->default('')->nullable();
            $table->string('link')->default('')->nullable();
            $table->smallInteger('type')->default(0)->nullable();
            $table->text('code')->nullable();
            $table->integer('views')->default(0)->nullable();
            $table->integer('image_id')->default(0)->nullable();
            $table->string('image_url')->nullable();
            $table->smallInteger('status')->default(1)->nullable();
            $table->integer('order_by')->default(0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
            $table->integer('editor_id')->default(0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->index('status', 'status');
            $table->index('position', 'position');
            $table->index('creator_id', 'creator_id');
            $table->index('deleted_at', 'deleted_at');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
