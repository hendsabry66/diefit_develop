<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->longText('details');
            $table->enum('has_price', ['true', 'false'])->default('true');
            $table->double('price')->default(0)->nullable();
            $table->integer('numberOfCalories')->default(0);
            $table->integer('fat_percentage')->default(0);
            $table->integer('protein_percentage')->default(0);
            $table->integer('Carbohydrate_percentage')->default(0);
            $table->integer('qty')->default(0);

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
        Schema::drop('extras');
    }
}
