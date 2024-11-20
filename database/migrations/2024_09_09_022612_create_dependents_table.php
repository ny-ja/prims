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
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('household_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('family_name');
            $table->date('birthday');
            $table->string('birthplace');
            $table->string('blood_type');
            $table->string('sex');
            $table->string('educational_attainment')->nullable();
            $table->string('course')->nullable();
            $table->string('relationship_to_head');
            $table->string('dependent_profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dependents');
    }
};
