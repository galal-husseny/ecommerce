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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price');
            $table->tinyInteger('status')->default(1)->comment('1=>pending (default),2=>shipped,3=>delivered,0=>canceled');
            $table->string('code',10)->unique();
            $table->timestamp('delivered_at')->nullable();
            $table->foreignId('address_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('coupon_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('payment_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('orders');
    }
};
