<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('property_value_id');
            $table->unsignedDecimal('price', 9, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'property_value_id']);

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('property_value_id')
                ->references('id')
                ->on('product_property_values');
        });

        DB::unprepared("
        DROP PROCEDURE IF EXISTS updateStock;
        DROP TRIGGER IF EXISTS stockTotalizerAfterInsert;
        DROP TRIGGER IF EXISTS stockTotalizerAfterUpdate;
        DROP TRIGGER IF EXISTS stockTotalizerAfterDelete;
        
        CREATE PROCEDURE updateStock(pid BIGINT(20))
        BEGIN
            UPDATE products 
            SET stock = (SELECT SUM(stock) 
                        FROM product_variants
                        WHERE product_id = pid) 
            WHERE id=pid;
        END");
        DB::unprepared("
        CREATE TRIGGER stockTotalizerAfterInsert
        AFTER INSERT ON product_variants
        FOR EACH ROW
            CALL updateStock(NEW.product_id);

        CREATE TRIGGER stockTotalizerAfterUpdate
        AFTER UPDATE ON product_variants
        FOR EACH ROW
            CALL updateStock(NEW.product_id);

        CREATE TRIGGER stockTotalizerAfterDelete
        AFTER DELETE ON product_variants
        FOR EACH ROW
            CALL updateStock(OLD.product_id);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
