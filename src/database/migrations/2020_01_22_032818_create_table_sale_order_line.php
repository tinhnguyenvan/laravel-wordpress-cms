<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSaleOrderLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_line', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->default(0)->nullable();
            $table->bigInteger('customer_id')->default(0)->nullable();
            $table->integer('order_id')->default(0)->nullable();
            $table->integer('sale_store_id')->default(0)->nullable();
            $table->string('order_code', 50)->nullable()->default('');
            $table->bigInteger('product_id')->default(0)->nullable();
            $table->string('product_sku', 100)->default('')->nullable();
            $table->string('product_name')->default('')->nullable();
            $table->integer('product_group_id')->default(0)->nullable();
            $table->integer('product_category_id')->default(0)->nullable();
            $table->integer('product_unit_id')->default(0)->nullable();
            $table->integer('product_type_id')->default(0)->nullable();
            $table->integer('product_division_id')->default(0)->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table->decimal('item_price_cost', 18, 2)->default(0)->nullable();
            $table->decimal('item_price_sell', 18, 2)->default(0)->nullable();
            $table->decimal('cost_total', 18, 2)->default(0)->nullable();
            $table->decimal('sub_total', 18, 2)->default(0)->nullable();
            $table->smallInteger('status')->default(0)->nullable();
            $table->smallInteger('report_year')->nullable()->default(0);
            $table->smallInteger('report_month')->nullable()->default(0);
            $table->smallInteger('report_date')->nullable()->default(0);
            $table->integer('creator_id')->nullable()->default(0);
            $table->integer('editor_id')->nullable()->default(0);
            $table->timestamp('completed_at', 0)->nullable();
            $table->timestamp('cancelled_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('organization_id', 'organization_id');
            $table->index('status', 'status');
            $table->index('order_id', 'order_id');
            $table->index('customer_id', 'customer_id');
            $table->index('creator_id', 'creator_id');
            $table->index('editor_id', 'editor_id');
            $table->index('deleted_at', 'deleted_at');

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
        Schema::dropIfExists('sale_order_line');
    }
}
