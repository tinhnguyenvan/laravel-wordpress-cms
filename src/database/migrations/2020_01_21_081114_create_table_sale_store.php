<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableSaleStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_store', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->default(0)->nullable();
            $table->string('code', 50)->nullable()->default('');
            $table->string('name')->nullable()->default('');
            $table->string('phone', 20)->nullable()->default('');
            $table->string('address')->nullable()->default('');
            $table->string('country_code', 10)->nullable()->default('');
            $table->integer('city_id')->nullable()->default(0);
            $table->string('city_name', 100)->nullable()->default('');
            $table->integer('district_id')->nullable()->default(0);
            $table->string('district_name', 100)->nullable()->default('');
            $table->integer('ward_id')->nullable()->default(0);
            $table->string('ward_name', 100)->nullable()->default('');
            $table->integer('inventory_warehouse_id')->nullable()->default(0);
            $table->integer('supervisor_id')->nullable()->default(0);
            $table->smallInteger('status')->nullable()->default(0);
            $table->integer('creator_id')->nullable()->default(0);
            $table->integer('editor_id')->nullable()->default(0);
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('organization_id', 'organization_id');
            $table->index('status', 'status');
            $table->index('city_id', 'city_id');
            $table->index('district_id', 'district_id');
            $table->index('ward_id', 'ward_id');
            $table->index('creator_id', 'creator_id');
            $table->index('editor_id', 'editor_id');
            $table->index('deleted_at', 'deleted_at');

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        DB::table('sale_store')->insert([
            'id' => 1,
            'organization_id' => 1,
            'code' => 'SS01',
            'name' => 'Sale Store 01',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_store');
    }
}
