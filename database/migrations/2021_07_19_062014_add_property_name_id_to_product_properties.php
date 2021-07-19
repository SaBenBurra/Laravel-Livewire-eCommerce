<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyNameIdToProductProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_properties', function (Blueprint $table) {
             $table->unsignedBigInteger('property_name_id')->after('product_id');

             $table->foreign('property_name_id')
                 ->references('id')
                 ->on('product_property_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_properties', function (Blueprint $table) {
            //
        });
    }
}
