<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id');
            $table->string('product_name');
            $table->string('description');
            $table->string('image')->default('unavailable.png');
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->double('price', 8, 2);
            $table->enum('status',['AVAILABLE','UNAVAILABLE','RESERVE','OUT OF STOCK']);
            $table->bigInteger('qty')->default(0);
            $table->bigInteger('critical_amount')->default(0);
            $table->string('height')->nullable();
            $table->string('color')->nullable();
            $table->string('width')->nullable();
            $table->string('weight')->nullable();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('products');
    }
}
