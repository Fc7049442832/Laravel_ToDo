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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15);
            $table->integer('age')->nullable();
            $table->string('gen', 5)->nullable(); // Gender
            $table->string('city')->nullable();
            $table->string('pin', 10)->nullable();
            $table->string('university')->nullable();
            $table->string('college')->nullable();
            $table->string('dept')->nullable(); // Department
            $table->string('batch')->nullable(); // Batch year
            $table->string('role')->nullable(); // Role in college
            $table->date('start')->nullable(); // Start date
            $table->date('end')->nullable(); // End date
            $table->string('subject')->nullable();
            $table->string('file')->nullable(); // File path or name
            $table->string('fname')->nullable(); // Father's name
            $table->string('mname')->nullable(); // Mother's name
            $table->string('update_key')->nullable(); 
            $table->timestamps(); // Adds created_at and updated_at
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
