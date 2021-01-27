<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 24)->nullable()->default(null);
            $table->string('name', 255)->nullable()->default(null);
            $table->smallInteger('level')->nullable()->default(0);
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('order_by')->nullable()->default(0);
            $table->boolean('is_primary_location')->nullable()->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index('code', 'code');
            $table->index('name', 'name');
            $table->index('parent_id', 'parent_id');
            $table->index('deleted_at', 'deleted_at');

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
        Schema::dropIfExists('regions');
    }
}
