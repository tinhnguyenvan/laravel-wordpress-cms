<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id')->default(0)->nullable();
            $table->string('code', 50)->nullable()->default('');
            $table->bigInteger('customer_id')->default(0)->nullable();
            $table->integer('sale_store_id')->default(0)->nullable();
            $table->integer('inventory_warehouse_id')->default(0)->nullable();
            $table->smallInteger('payment_method')->nullable()->default(0);
            $table->string('billing_fullname')->nullable()->default('');
            $table->smallInteger('billing_gender')->nullable()->default(0);
            $table->string('billing_email', 100)->nullable()->default('');
            $table->string('billing_phone', 20)->nullable()->default('');
            $table->string('billing_address')->nullable()->default('');
            $table->integer('billing_city_id')->default(0)->nullable();
            $table->integer('billing_district_id')->default(0)->nullable();
            $table->integer('billing_ward_id')->default(0)->nullable();
            $table->string('shipping_fullname')->nullable()->default('');
            $table->string('shipping_phone', 20)->nullable()->default('');
            $table->string('shipping_address')->nullable()->default('');
            $table->integer('shipping_city_id')->default(0)->nullable();
            $table->integer('shipping_district_id')->default(0)->nullable();
            $table->integer('shipping_ward_id')->default(0)->nullable();
            $table->string('tags')->nullable()->default('');
            $table->text('note')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->decimal('price_cost', 18, 2)->default(0)->nullable();
            $table->decimal('price_sell', 18, 2)->default(0)->nullable();
            $table->decimal('price_tax', 18, 2)->default(0)->nullable();
            $table->decimal('price_discount', 18, 2)->default(0)->nullable();
            $table->decimal('price_final', 18, 2)->default(0)->nullable();
            $table->smallInteger('sell_type')->nullable()->default(0);
            $table->boolean('is_generate_invoice')->nullable()->default(0);
            $table->string('invoice_code', 32)->nullable()->default('');
            $table->integer('invoice_id')->default(0)->nullable();
            $table->smallInteger('status')->nullable()->default(0);
            $table->integer('creator_id')->nullable()->default(0);
            $table->integer('editor_id')->nullable()->default(0);
            $table->timestamp('completed_at', 0)->nullable();
            $table->timestamp('cancelled_at', 0)->nullable();
            $table->timestamp('deleted_at', 0)->nullable();

            $table->index('organization_id', 'organization_id');
            $table->index('status', 'status');
            $table->index('customer_id', 'customer_id');
            $table->index('billing_city_id', 'billing_city_id');
            $table->index('sale_store_id', 'sale_store_id');
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
        Schema::dropIfExists('sale_order');
    }
}
