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
        Schema::create('waste_logs', function (Blueprint $table) {
            $table->id('WasteLogID');
            $table->unsignedBigInteger('RestaurantOwnerID');
            $table->foreign('RestaurantOwnerID')->references('RestaurantOwnerID')->on('restaurant_owners');
            $table->string('WasteType');
            $table->integer('Weight');
            $table->date('DateLogged');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_logs');
    }
};
