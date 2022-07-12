<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientPizzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_pizza', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->unsignedBigInteger('pizza_id');
            $table->unsignedBigInteger('ingredient_id');

            $table->foreign('pizza_id')
                                    ->references('id')
                                    ->on('pizzas')
                                    ->onDelete('cascade');

            $table->foreign('ingredient_id')
                                    ->references('id')
                                    ->on('ingredients')
                                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_pizza');
    }
}
