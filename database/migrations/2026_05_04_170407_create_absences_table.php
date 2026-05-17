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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la table agents
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');

            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->integer('nb_jours');
            $table->year('annee'); // Année d'imputation

            $table->enum('type', [
                'normale',
                'mariage',
                'bapteme',
                'deces_proche',
                'autre_exceptionnelle'
            ])->default('normale');

            $table->boolean('est_deductible')->default(true);
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
        Schema::dropIfExists('absences');
    }
};
