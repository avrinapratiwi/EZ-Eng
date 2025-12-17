<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('module_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->boolean('completed')->default(false); // apakah modul selesai
            $table->foreignId('quiz_attempt_id')->nullable()->constrained('quiz_attempts')->onDelete('set null'); // quiz yang sudah di-submit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_progress');
    }
};
