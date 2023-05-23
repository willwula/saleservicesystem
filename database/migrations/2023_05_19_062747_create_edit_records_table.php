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
        Schema::create('edit_records', function (Blueprint $table) {
            $table->id();
            $table->string('manager_name');//去撈manager表單的name,紀錄誰更新的
            $table->string('status');//紀錄repairs表單每一筆更新狀態的過程, 待判別=>過保
            $table->string('description');//編輯時的備註
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
        Schema::dropIfExists('edit_records');
    }
};
