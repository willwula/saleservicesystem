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
        Schema::create('bike_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bike_part_id');
            $table->string('partial_number')->unique();
            $table->decimal('price', 11,2);
            $table->integer('warranty_month');
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
        Schema::dropIfExists('bike_materials');
    }
};
