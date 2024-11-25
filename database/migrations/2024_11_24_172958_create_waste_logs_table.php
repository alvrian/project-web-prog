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
            $table->decimal('Weight', 8, 2);
            $table->date('DateLogged');
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('SubscriptionID');
            $table->unsignedBigInteger('SubscriberID');
            $table->string('subscriber_type');
            $table->unsignedBigInteger('ProviderID');
            $table->string('provider_type');
            $table->string('SubscriptionType');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('Status');

            $table->index(['SubscriberID', 'subscriber_type']);
            $table->index(['ProviderID', 'provider_type']);
        });

        Schema::create('pickup_schedules', function (Blueprint $table) {
            $table->id('PickupID');
            $table->unsignedBigInteger('ParticipantID');
            $table->string('participant_type');
            $table->string('PickupType');
            $table->date('ScheduledDate');
            $table->string('Status');
            
            $table->index(['PickupID', 'participant_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_logs');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('pickup_schedules');
    }
};
