<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('price_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('WasteLogID');
            $table->decimal('price_per_kg', 8, 2)->nullable();
            $table->decimal('price_per_subscription_3', 8, 2)->nullable();
            $table->decimal('price_per_subscription_6', 8, 2)->nullable();
            $table->decimal('price_per_subscription_9', 8, 2)->nullable();
            $table->decimal('price_per_subscription_12', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('WasteLogID')->references('id')->on('waste_log')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_log_price_list');
    }
};
