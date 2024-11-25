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
        Schema::create('points_transactions', function (Blueprint $table) {
            $table->id('TransactionID'); // Primary key
            $table->unsignedBigInteger('ParticipantID'); // ID of the participant
            $table->string('ParticipantType'); // Model type (e.g., RestaurantOwner, CompostProducer, Farmer)
            $table->string('TransactionType'); // Earned or Redeemed
            $table->integer('Points'); // Points earned or redeemed
            $table->string('Description')->nullable(); // Description of the transaction
            $table->date('Date');

            $table->index(['ParticipantID', 'ParticipantType']);
        });

        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('FeedbackID'); // Primary key
            $table->unsignedBigInteger('ReviewerID'); // ID of the reviewer
            $table->string('ReviewerType'); // Model type for the reviewer (RestaurantOwner, CompostProducer, Farmer)
            $table->unsignedBigInteger('RevieweeID'); // ID of the reviewee
            $table->string('RevieweeType'); // Model type for the reviewee (RestaurantOwner, CompostProducer, Farmer)
            $table->integer('Rating'); // Rating (1-5 or as required)
            $table->text('Comments')->nullable(); // Comments given by the reviewer
            $table->date('Date'); // Date of the feedback
        
            $table->index(['ReviewerID', 'ReviewerType']);
            $table->index(['RevieweeID', 'RevieweeType']);
        });

        Schema::create('catalogs', function (Blueprint $table) {
            $table->id('CatalogID'); // Primary key
            $table->string('Type'); // Type of the entity (Farmer, CompostProducer)
            $table->unsignedBigInteger('ItemID'); // ID of the respective entity (FarmerID or CompostProducerID)
            $table->string('Location'); // Location of the catalog item (e.g., farm location, compost producer's location)
            $table->text('AvailableItems'); // Types of items (e.g., crop types, compost types)
            $table->enum('AvailabilityStatus', ['Available', 'Out of Stock', 'Limited'])->default('Available'); // Availability status
        
            // Add index for polymorphic relationship
            $table->index(['ItemID', 'Type']); // Composite index for polymorphic relationship
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_transactions');
    }
};
