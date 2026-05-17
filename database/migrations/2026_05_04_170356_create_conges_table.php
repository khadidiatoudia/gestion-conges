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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');

            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_cessation_service')->nullable();
            $table->date('date_reprise_service')->nullable();
            $table->integer('nb_jours');
            $table->year('annee');

            $table->enum('type', [
                'normale',
                'maternite',
                'accident_travail',
                'maladie',
                'autre'
            ])->default('normale');

            $table->enum('statut', ['en_attente', 'approuve', 'refuse'])->default('en_attente');
            $table->string('numero_autorisation')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
