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
        Schema::create('points_transaction', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('TransactionID');
            $table->unsignedBigInteger('ParticipantID');
            $table->string('TransactionType');
            $table->integer('Points');
            $table->text('Description')->nullable();
            $table->date('Date');
            $table->string('Status');
            $table->timestamps();

            $table->foreign('ParticipantID')->references('RestaurantOwnerID')->on('restaurant_owner')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_transaction');
    }
};
