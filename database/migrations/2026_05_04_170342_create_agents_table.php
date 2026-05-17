<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('matricule_solde')->unique();
            $table->enum('genre', ['M', 'F'])->default('M');
            $table->integer('nb_enfants')->default(0);
            $table->string('lieu_affectation');
            $table->enum('type_affectation', ['direction', 'ufr', 'rectorat', 'vice_recteur']);
            $table->enum('statut_contractuel', ['titulaire', 'contractuel'])->default('titulaire');
            $table->date('date_prise_de_service');
            $table->boolean('actif')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
