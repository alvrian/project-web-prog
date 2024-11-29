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
        Schema::create('restaurant_owner', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('Name');
            $table->string('Location');
            $table->string('Type');
            $table->decimal('AverageFoodWastePerMonth', 8, 2)->nullable();
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
        Schema::dropIfExists('restaurant_owner');
    }
};
