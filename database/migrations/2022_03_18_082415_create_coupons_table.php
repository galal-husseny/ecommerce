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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->tinyInteger('discount');
            $table->enum('discount_type',['f','p'])->default('f')->comment('f=>fixed (default),p=>percentage');
            $table->smallInteger('mini_order_price')->nullable();
            $table->smallInteger('max_discount_value')->nullable();
            $table->smallInteger('max_usage_count')->nullable();
            $table->smallInteger('max_usage_count_per_user')->nullable();
            $table->tinyInteger('website_percentage')->default('100');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
