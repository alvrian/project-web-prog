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
        Schema::create('pickup_schedule', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('SenderRestaurantOwnerID')->nullable();
            $table->unsignedBigInteger('SenderCompostProducerID')->nullable();
            $table->unsignedBigInteger('SenderFarmerID')->nullable();
            $table->unsignedBigInteger('RecipientRestaurantOwnerID')->nullable();
            $table->unsignedBigInteger('RecipientCompostProducerID')->nullable();
            $table->unsignedBigInteger('RecipientFarmerID')->nullable();
            $table->enum('PickupType', ['Waste Pickup', 'Compost Delivery']);
            $table->dateTime('ScheduledDate');
            $table->enum('Status', ['Scheduled', 'Completed', 'Missed']);
            $table->timestamps();

            $table->foreign('SenderRestaurantOwnerID')
                ->references('id')->on('restaurant_owner')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('SenderCompostProducerID')
                ->references('id')->on('compost_producer')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('SenderFarmerID')
                ->references('id')->on('farmer')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('RecipientRestaurantOwnerID')
                ->references('id')->on('restaurant_owner')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('RecipientCompostProducerID')
                ->references('id')->on('compost_producer')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('RecipientFarmerID')
                ->references('id')->on('farmer')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_schedule');
    }
};
