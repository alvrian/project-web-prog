<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompostEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('compost_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compost_producer_id');
            $table->string('compost_producer_name');
            $table->string('compost_types_produced');
            $table->decimal('average_compost_amount', 8, 2);
            $table->decimal('kitchen_waste_capacity', 8, 2);
            $table->date('date_logged');
            $table->timestamps();

            $table->foreign('compost_producer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('compost_entries');
    }
};

