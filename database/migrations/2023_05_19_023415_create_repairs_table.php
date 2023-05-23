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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('repair_order_number');//報修單流水號 YY/MM/DD+6碼
            $table->unsignedBigInteger('dealer_id');//建制外鍵對應role
            //$table->foreign('dealer_id')->references('role')->on('managers');//managers尚未創建
            $table->unsignedBigInteger('update_manager_id');//外鍵對應manager id ,關聯關係
            $table->string('bike_brand_name');//廠牌的名字,無關聯關係
            $table->string('bike_model_name');//車型的名字,無關聯關係
            $table->string('serial_number');//新增報修時填入
            $table->string('customer_description');//新增報修時,客戶備註
            $table->string('part_issue_description');//抓部件問題的描述,關聯關係
            $table->string('description');//經銷商問題描述
            $table->string('material_partial_number');//抓料號表單 SN碼, 關聯關係
            $table->string('shipper_name');//去撈物流商的名字,無對應關係
            $table->string('MID');//新增報修時填入
            $table->string('motor_barcode');//經銷商掃條碼用
            $table->integer('status')->default('1');//數字代表狀態 過保....等
            $table->decimal('repair_fee', 11, 2)->nullable();//維修費 可為空值
            $table->string('shipping_fee');//運費 由 服務中心/管理員填入
            $table->string('tracking_number');//追蹤號碼 由 服務中心/管理員填入
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
        Schema::dropIfExists('repairs');
    }
};
