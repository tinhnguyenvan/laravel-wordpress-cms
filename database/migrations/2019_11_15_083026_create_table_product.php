<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->default('')->nullable();
            $table->string('title')->default('')->nullable();
            $table->integer('vendor_id')->default(0)->nullable();
            $table->integer('category_id')->default(0)->nullable();
            $table->text('summary')->nullable();
            $table->text('detail')->nullable();
            $table->integer('image_id')->default(0)->nullable();
            $table->string('image_url')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('price', 18, 2)->default(0)->nullable();
            $table->decimal('price_promotion', 18, 2)->default(0)->nullable();
            $table->smallInteger('status')->default(1)->nullable();
            $table->string('slug')->default('')->nullable();
            $table->string('seo_title')->default('')->nullable();
            $table->string('seo_description')->default('')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->integer('creator_id')->default(0)->nullable();
            $table->integer('editor_id')->default(0)->nullable();

            // add index
            $table->index('category_id', 'category_id');
            $table->index('status', 'status');
            $table->index('sku', 'sku');
            $table->index('vendor_id', 'vendor_id');
            $table->index('image_id', 'image_id');
            $table->index('deleted_at', 'deleted_at');
            $table->index('creator_id', 'creator_id');
            $table->index('editor_id', 'editor_id');

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
        Schema::dropIfExists('products');
    }
}
