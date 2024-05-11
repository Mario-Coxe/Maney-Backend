<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('atm_agents', function (Blueprint $table) {
            $table->primary('atm_id');
            $table->unsignedBigInteger('atm_id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('atm_id')->references('id')->on('atms');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atm_agents');
    }
};
