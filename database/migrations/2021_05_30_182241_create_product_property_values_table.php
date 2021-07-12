<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPropertyValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_property_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_name_id');
            $table->string('value',60);
            $table->timestamps();

            $table->foreign('property_name_id')
                ->references('id')
                ->on('product_property_names');

            $table->unique(['property_name_id', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_property_values');
    }
}
