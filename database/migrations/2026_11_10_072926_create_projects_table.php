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
        Schema::create('projects', function (Blueprint $table) { //Creamos la tabla projects

        // Blueprint para definir las columnas de la tabla, $table es un nombre identificativo
            $table->id();
            
            // Relación 1:N (Usuario propietario)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            //constrained sirve para vincular con la tabla
            
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('status')->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
