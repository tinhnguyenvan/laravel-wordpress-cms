<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname')->nullable()->default('');
            $table->string('phone', 20)->nullable()->default('');
            $table->string('email', 50)->nullable()->default('');
            $table->integer('contact_form_id')->nullable()->default(0);
            $table->text('request_content_form')->nullable();
            $table->smallInteger('status')->nullable()->default(1);
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('deleted_at', 'deleted_at');
            $table->index('status', 'status');
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
        Schema::dropIfExists('contact');
    }
}
