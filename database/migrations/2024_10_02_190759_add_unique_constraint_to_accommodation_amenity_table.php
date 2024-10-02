<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accommodation_amenity', function (Blueprint $table) {
            $table->unique(['accommodation_id','amenity_id']);
        });
    }
    public function down(): void
    {
        Schema::table('accommodation_amenity', function (Blueprint $table) {
        });
    }
};
