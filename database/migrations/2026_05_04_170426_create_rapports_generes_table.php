<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter la migration.
     */
    public function up(): void
    {
        Schema::create('rapports_generes', function (Blueprint $table) {
            $table->id();
            // L'utilisateur (admin/rh) qui a généré le rapport
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('type_structure', [
                'direction', 'ufr', 'rectorat', 'vice_recteur', 'tous'
            ]);

            $table->string('nom_structure')->nullable(); // ex: "UFR SET" ou "Direction des Finances"
            $table->year('annee');

            // Stockage du lien vers le fichier (ex: storage/reports/rapport_2024_ufr.pdf)
            $table->string('chemin_fichier')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Annuler la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapports_generes');
    }
};
