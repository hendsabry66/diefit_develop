<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('id');

//            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
            $table->string('name');
            $table->text('details');
            $table->boolean('has_specialist')->default(0);
            $table->double('specialist_price_for_session')->default(0);
            $table->integer('suggested_session_number')->default(0);
            $table->integer('period');
            $table->boolean('has_calories')->default(0);
            $table->integer('calories')->default(0);
            $table->boolean('has_quantities')->default(0);
            $table->integer('quantities')->default(0);
            $table->boolean('has_meals')->default(0);
            $table->integer('meals')->default(0);
            $table->integer('number_of_delivery_days');
            $table->double('price')->default(0);
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
        Schema::drop('subscriptions');
    }
}
