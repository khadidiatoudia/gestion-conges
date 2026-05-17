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
        Schema::create('jours_feries', function (Blueprint $table) {
            $table->id();
            // On retire le unique() ici pour permettre la même date sur différentes années
            $table->date('date');

            $table->string('libelle');

            // L'année peut être nulle si le jour est fixe/récurrent chaque année
            $table->year('annee')->nullable();

            $table->boolean('recurrent')->default(true);
            $table->timestamps();

            // On autorise le même jour sur la même date si le libellé est différent.
            $table->unique(['date', 'libelle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jours_feries');
    }
};
