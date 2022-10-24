<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekFoodsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_foods', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');

            $table->foreignId('food_type_id')->constrained('food_types')->onDelete('cascade');

            $table->integer('day')->default(0);

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
        Schema::drop('week_foods');
    }
}
