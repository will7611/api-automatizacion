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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('preferred_schedule')->nullable(); // mañana, tarde, fin de semana
            
            // Origen (Meta Ads, TikTok, Orgánico)
            $table->string('source')->nullable(); 
            
            // Qué propiedad le interesó
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            
            // Estado del cliente en el embudo (nuevo, contactado, cita_agendada, cerrado)
            $table->enum('status', ['nuevo', 'contactado', 'cita_agendada', 'cerrado', 'perdido'])->default('nuevo');
            
            // Asesor asignado (relación con tabla users)
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
