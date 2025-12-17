<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->string('description'); 
            $table->string('image'); 
            $table->integer('order')->default(1); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
