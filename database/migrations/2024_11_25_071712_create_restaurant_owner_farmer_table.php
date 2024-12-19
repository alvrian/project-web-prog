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
        Schema::create('restaurant_owner_farmer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('RestaurantOwnerID');
            $table->unsignedBigInteger('FarmerID');
            $table->timestamps();

            $table->foreign('RestaurantOwnerID')->references('id')->on('restaurant_owner')->onDelete('cascade');
            $table->foreign('FarmerID')->references('id')->on('farmer')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_owner_farmer');
    }
};
