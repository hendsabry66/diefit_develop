<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_categories', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('food_categories')->onDelete('cascade');
            $table->enum('status', ['active', 'in_active'])->default('in_active');
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
        Schema::drop('food_categories');
    }
}
