<?php

use App\Enums\RoomType;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accommodation_id')->constrained('accommodation')->onDelete('cascade');
            $table->enum('type',RoomType::cases());
            $table->integer('capacity');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
