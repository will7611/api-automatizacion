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
          Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Para la URL: mi-sitio.com/casa-zona-sur
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('currency')->default('USD');
            
            // Características
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('parking_spaces')->default(0);
            $table->integer('square_meters')->default(0);
            
            // Amenidades (Guardado como JSON para no hacer una tabla extra por ahora)
            $table->json('amenities')->nullable(); 
            
            // Estado (disponible, vendido, preventa)
            $table->enum('status', ['disponible', 'vendido', 'preventa'])->default('disponible');
            
            // Foto principal
            $table->string('main_image_url')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
