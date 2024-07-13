<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orderlists', function (Blueprint $table) {
            $table->id('order_list_id');
            $table->string('order_code');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price_per_unit');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderlists');
    }
};
