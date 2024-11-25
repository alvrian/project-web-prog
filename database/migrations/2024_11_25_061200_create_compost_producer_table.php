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
        Schema::create('compost_producer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('CompostProducerID');
            $table->string('Name');
            $table->string('Location');
            $table->text('CompostTypesProduced');
            $table->decimal('AverageCompostAmountPerTerm', 8, 2)->nullable();
            $table->unsignedBigInteger('WasteProcessingCapacity');
            $table->unsignedBigInteger('PointsBalance')->default(0);
            $table->unsignedBigInteger('AmountBalance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compost_producer');
    }
};