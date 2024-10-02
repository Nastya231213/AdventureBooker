<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('accommodation_amenity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accommodation_id')->constrained('accommodation')->onDelete('cascade');
            $table->foreignId('amenity_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodation_amenity');
    }
};
