<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_number', 13)->unique(); // maksimal 13 karakter
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'learner'])->default('learner');
            $table->enum('status', ['TIDAK AKTIF', 'AKTIF'])->default('TIDAK AKTIF');
            $table->string('email_verification_token')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

