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
        Schema::create('restaurant_owners', function (Blueprint $table) {
            $table->id('RestaurantOwnerID');
            $table->string('Name');
            $table->string('location');
            $table->string('type');
            $table->integer('AverageFoodWastePerMonth');
            $table->integer('PointsBalance');
        });
        Schema::create('compost_producers', function (Blueprint $table) {
            $table->id('CompostProducerID');
            $table->string('Name');
            $table->string('location');
            $table->string('CompostTypesProduced');
            $table->integer('AverageCompostAmountPerTerm');
            $table->integer('KitchenWasteProcessingCapacity');
            $table->integer('PointsBalance');
        });
        Schema::create('farmers', function (Blueprint $table) {
            $table->id('FarmerID');
            $table->string('Name');
            $table->string('Location');
            $table->string('CropTypesProduced');
            $table->date('HarvestSchedule');
            $table->integer('AverageCropAmountPerQuarter');
            $table->integer('PointsBalance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_owners');
        Schema::dropIfExists('compost_producers');
        Schema::dropIfExists('farmers');
    }
};
