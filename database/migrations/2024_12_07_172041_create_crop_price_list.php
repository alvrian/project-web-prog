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
        Schema::create('crop_price_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_id');
            $table->decimal('price_per_item', 8, 2);
            $table->decimal('price_per_subscription_3', 8, 2);
            $table->decimal('price_per_subscription_6', 8, 2);
            $table->decimal('price_per_subscription_9', 8, 2);
            $table->decimal('price_per_subscription_12', 8, 2);
            $table->timestamps();

            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_price_list');
    }
};
