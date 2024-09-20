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
        Schema::create('business_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_establishment_id')->constrained()->onDelete('cascade');
            $table->string('manager_name');
            $table->string('manager_contact_number');
            $table->string('manager_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_managers');
    }
};
