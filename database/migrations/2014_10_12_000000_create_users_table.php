<?php

use App\Constants\Enum;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('specialty_id')->nullable();
            $table->string('photo')->default('blank.png');
            $table->tinyInteger('role')->default(Enum::ADMIN); // admin
            $table->boolean('is_deleted')->default(false);
            $table->boolean('verified_by_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
