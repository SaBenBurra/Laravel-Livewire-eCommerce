<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->string('comment', 800)->nullable();
            $table->unsignedInteger('rating');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unique(['product_id', 'user_id']);
        });

        DB::unprepared("
        DROP PROCEDURE IF EXISTS updateRating;
        DROP TRIGGER IF EXISTS updateRatingAvgAfterInsert;
        DROP TRIGGER IF EXISTS updateRatingAvgAfterUpdate;
        DROP TRIGGER IF EXISTS updateRatingAvgAfterDelete;
        
        CREATE PROCEDURE updateRating(pid BIGINT(20))
        BEGIN
            UPDATE products
            SET rating_average = (SELECT AVG(rating) FROM reviews
                           WHERE product_id = pid)
            WHERE id = pid;
        END");
        DB::unprepared("
        CREATE TRIGGER ratingAvgAfterInsert
        AFTER INSERT ON reviews
        FOR EACH ROW
            CALL updateRating(NEW.product_id);
        
        CREATE TRIGGER ratingAvgAfterUpdate
        AFTER UPDATE ON reviews
        FOR EACH ROW
            CALL updateRating(NEW.product_id);
            
        CREATE TRIGGER ratingAvgAfterDelete
        AFTER DELETE ON reviews
        FOR EACH ROW
            CALL updateRating(OLD.product_id);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
