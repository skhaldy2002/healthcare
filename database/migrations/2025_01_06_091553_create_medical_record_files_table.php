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
        Schema::create('medical_record_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->nullable();
            $table->string('name')->nullable();
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_files');
    }
};
