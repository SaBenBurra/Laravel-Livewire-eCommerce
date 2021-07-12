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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name', 500);
            $table->unsignedDecimal('price', 9, 2);
            $table->string('slug', 500)->unique();
            $table->string('serial_number',20)->unique();
            $table->unsignedInteger('stock')->default(0);
            $table->string('description', 1500)->nullable();
            $table->unsignedDecimal('rating_average', 3,2)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands');
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
