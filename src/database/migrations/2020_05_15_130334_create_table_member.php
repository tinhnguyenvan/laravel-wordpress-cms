<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('source')->nullable()->default(0);
            $table->string('source_id')->nullable()->default('');
            $table->string('username')->nullable()->default('');
            $table->string('password')->nullable()->default('');
            $table->string('fullname')->nullable()->default('');
            $table->string('first_name')->nullable()->default('');
            $table->string('last_name')->nullable()->default('');
            $table->string('phone', 20)->nullable()->default('');
            $table->string('email', 50)->nullable()->default('');
            $table->string('address', 50)->nullable()->default('');
            $table->smallInteger('status')->nullable()->default(1);
            $table->integer('image_id')->nullable()->default(0);
            $table->string('image_url')->nullable()->default('');
            $table->integer('country_id')->nullable()->default(0);
            $table->integer('city_id')->nullable()->default(0);
            $table->integer('district_id')->nullable()->default(0);
            $table->integer('ward_id')->nullable()->default(0);
            $table->smallInteger('birth_day')->nullable()->default(0);
            $table->smallInteger('birth_month')->nullable()->default(0);
            $table->smallInteger('birth_year')->nullable()->default(0);
            $table->date('birthday')->nullable();
            $table->smallInteger('gender')->nullable()->default(0);
            $table->string('tags')->nullable()->default('');
            $table->text('bio')->nullable();

            $table->index('source', 'source');
            $table->index('city_id', 'city_id');
            $table->index('deleted_at', 'deleted_at');
            $table->index('status', 'status');

            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
