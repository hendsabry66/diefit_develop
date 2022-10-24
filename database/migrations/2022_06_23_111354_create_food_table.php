<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->longText('details');
            $table->string('image');
            $table->double('price')->default(0);
            $table->integer('numberOfCalories')->default(0);
            $table->integer('fat_percentage')->default(0);
            $table->integer('protein_percentage')->default(0);
            $table->integer('Carbohydrate_percentage')->default(0);
            $table->longText('ingredients');
            $table->integer('qty')->default(0);
            $table->foreignId('food_category_id')->constrained('food_categories')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food');
    }
}
