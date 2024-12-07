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
        Schema::create('waste_log', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id');
            $table->unsignedBigInteger('RestaurantOwnerID');
            $table->string('WasteType');
            $table->decimal('Weight', 8, 2);
            $table->date('DateLogged');
            $table->timestamps();

            $table->foreign('RestaurantOwnerID')
                ->references('id')
                ->on('restaurant_owner')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_log');
    }
};
