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
        Schema::create('compost_producer_farmer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('CompostProducerID');
            $table->unsignedBigInteger('FarmerID');
            $table->timestamps();

            $table->foreign('CompostProducerID')->references('id')->on('compost_producer')->onDelete('cascade');
            $table->foreign('FarmerID')->references('id')->on('farmer')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compost_producer_farmer');
    }
};
