<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('name');
            $table->string('slug');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')->on('product_categories')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->double('price')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->enum('discount_type', ['flat', 'percent'])->nullable();
            $table->integer('unit_qty')->default(1);
            $table->enum('unit', ['kg', 'gm', 'ltr', 'ml', 'pcs'])->default('kg');
            $table->integer('out_of_stock')->default(0);
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('publish')->default(0);
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
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
