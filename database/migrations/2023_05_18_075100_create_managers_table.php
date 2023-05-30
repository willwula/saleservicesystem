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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role')->default(\App\Models\Manager::ROLE_DEALER);
            $table->tinyInteger('status')->default(\App\Models\Manager::STATUS_DISABLED);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('serviceCenter_id')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
    }
};
