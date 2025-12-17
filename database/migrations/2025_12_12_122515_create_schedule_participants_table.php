<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_participants', function (Blueprint $table) {
            $table->id();

            // Relasi ke schedules
            $table->foreignId('schedule_id')
                  ->constrained('schedules')
                  ->onDelete('cascade');

            // Relasi ke users (learner)
            $table->foreignId('learner_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Status kehadiran (English)
            $table->enum('status', ['PRESENT', 'ABSENT'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_participants');
    }
};
