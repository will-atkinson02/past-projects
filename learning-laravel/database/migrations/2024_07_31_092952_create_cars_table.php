<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// A migration allows us to control the structure of our database using PHP
// We can use them to create tables, or to edit existing tables
// When working with Laravel we NEVER use the structure tab in sequel ace to change the database
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // We specify what changes we want to make to the database
    public function up(): void
    {
        // Defining what columns the cars table is going to have
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make', 50);
            $table->string('model', 100);
            $table->string('description', 1000)->nullable();
            $table->float('price');
            $table->integer('seats');
            $table->boolean('owned');
            $table->timestamps(); // Tells up when each row got added, and when they last got changed
        });
    }

    /**
     * Reverse the migrations.
     */
    // We specify how to reverse/undo these changes
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
