<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('post_id');
            $table->string('author', 100)->default('')->nullable();
            $table->string('author_email', 100)->default('')->nullable();
            $table->string('author_url')->default('')->nullable();
            $table->string('author_ip', 100)->default('')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('content')->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->string('agent', 100)->default('')->nullable();
            $table->smallInteger('type')->default(0)->nullable();
            $table->integer('parent')->default(0)->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
            $table->integer('editor_id')->default(0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('post_id', 'post_id');
            $table->index('approved', 'approved');
            $table->index('parent', 'parent');
            $table->index('user_id', 'user_id');
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
        Schema::dropIfExists('comments');
    }
}
