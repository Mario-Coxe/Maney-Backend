<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtmsTable extends Migration
{
    public function up()
    {
        Schema::create('atms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('address');
            $table->boolean('has_cash')->default(false);
            $table->boolean('has_paper')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atms');
    }
}
