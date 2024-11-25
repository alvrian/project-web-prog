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
        Schema::create('catalog', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('ItemID');
            $table->string('ItemType'); 
            $table->text('AvailableItems');
            $table->enum('AvailabilityStatus', ['Available', 'Out of Stock']);
            $table->timestamps();

            $table->index(['ItemID', 'ItemType']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog');
    }
};
