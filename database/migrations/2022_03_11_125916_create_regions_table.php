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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->tinyInteger('status')->default(0)->comment('0=>not deliverd,1=> delivered');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->decimal('radius',6,3)->nullable();
            $table->foreignId('city_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('regions');
    }
};
