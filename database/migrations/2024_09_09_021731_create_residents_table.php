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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('family_name');
            $table->string('contact_number');
            $table->string('email')->unique()->nullable();
            $table->date('birthday');
            $table->string('birthplace');
            $table->string('blood_type');
            $table->string('sex');
            $table->string('street_address');
            $table->string('employment_status');
            $table->string('employment_sector');
            $table->string('educational_attainment');
            $table->string('course');
            $table->json('social_classification')->nullable();
            $table->string('voter_status');
            $table->string('civil_status');
            $table->string('spouse_name')->nullable();
            $table->string('spouse_employment_status')->nullable();
            $table->string('spouse_employment_sector')->nullable();
            $table->string('spouse_educational_attainment')->nullable();
            $table->string('spouse_course')->nullable();
            
            $table->string('resident_profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
