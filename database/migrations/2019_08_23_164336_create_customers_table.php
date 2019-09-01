<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('name');
            $table->bigInteger('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->text('items');
            $table->double('amount_paid', 15, 2);
            $table->double('original_price', 15, 2);
            $table->double('discount', 15, 2)->nullable();
            $table->double('total', 15, 2);

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
        Schema::dropIfExists('customers');
    }
}
