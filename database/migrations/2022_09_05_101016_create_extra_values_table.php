<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->double('price')->nullable();
            $table->unsignedBigInteger('extra_id');
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');

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
        Schema::dropIfExists('extra_values');
    }
}
