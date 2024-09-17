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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('main_photo');
            $table->string('country');
            $table->string('city');
            $table->string('type')->default('hotel');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
