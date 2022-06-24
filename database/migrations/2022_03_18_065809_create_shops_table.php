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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('building');
            $table->string('floor');
            $table->text('notes')->nullable();
            $table->string('latitude',20);
            $table->string('longitude',20);
            $table->foreignId('region_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('seller_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('shops');
    }
};
