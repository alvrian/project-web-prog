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
        Schema::create('subscription', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('SubscriptionID');
            $table->unsignedBigInteger('SubscriberID');
            $table->unsignedBigInteger('ProviderID');
            $table->string('SubscriptionType');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('Status');
            $table->string('Reason');
            $table->unsignedBigInteger('Price');
            $table->unsignedBigInteger('PointEarned');
            $table->timestamps();

            $table->foreign('SubscriberID')->references('id')->on('restaurant_owner')->onDelete('cascade');
            $table->foreign('ProviderID')->references('id')->on('farmer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription');
    }
};
