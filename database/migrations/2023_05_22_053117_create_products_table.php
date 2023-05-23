<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->integer('customer_id');
            $table->string('product_number');
            $table->string('serial_number');
            $table->string('bike_brand_name');
            $table->string('bike_model_name');
            $table->date('registed_date');
            $table->integer('registed_status')->default(1);
            $table->string('mortor_barcode');
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
};
