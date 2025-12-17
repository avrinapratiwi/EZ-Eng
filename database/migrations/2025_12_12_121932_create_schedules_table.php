<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            // Link meeting (Zoom, GMeet)
            $table->string('meeting_link')->nullable();

            // Relasi ke mentors table
            $table->foreignId('mentor_id')
                  ->constrained('mentors')
                  ->onDelete('cascade');

            // Tanggal dan waktu
            $table->date('meeting_date');
            $table->time('meeting_time');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
