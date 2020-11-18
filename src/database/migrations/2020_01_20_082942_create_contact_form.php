<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContactForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_form', function (Blueprint $table) {
            $table->integer('id');
            $table->string('title')->nullable()->default('');
            $table->string('slug')->nullable()->default('');
            $table->text('content')->nullable();
            $table->smallInteger('status')->nullable()->default(1);
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('status', 'status');
            $table->index('deleted_at', 'deleted_at');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        DB::table('contact_form')->insert([
            'id' => 1,
            'title' => 'Form contact',
            'slug' => 'form_contact',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_form');
    }
}
