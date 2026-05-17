<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JourFerie;
use Illuminate\Support\Carbon;

class JoursFeriesSenegalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des jours fériés au Sénégal pour 2026
        $feries = [
            // Fêtes à dates fixes (Récurrentes)
            ['date' => '2026-01-01', 'libelle' => 'Jour de l\'An', 'recurrent' => true],
            ['date' => '2026-04-04', 'libelle' => 'Fête de l\'Indépendance', 'recurrent' => true],
            ['date' => '2026-05-01', 'libelle' => 'Fête du Travail', 'recurrent' => true],
            ['date' => '2026-08-15', 'libelle' => 'Assomption', 'recurrent' => true],
            ['date' => '2026-11-01', 'libelle' => 'Toussaint', 'recurrent' => true],
            ['date' => '2026-12-25', 'libelle' => 'Noël', 'recurrent' => true],

            // Fêtes à dates mobiles (Non récurrentes pour 2026)
            ['date' => '2026-03-20', 'libelle' => 'Maouloud (Naissance du Prophète)', 'recurrent' => false],
            ['date' => '2026-04-03', 'libelle' => 'Vendredi Saint', 'recurrent' => false],
            ['date' => '2026-04-06', 'libelle' => 'Lundi de Pâques', 'recurrent' => false],
            ['date' => '2026-05-14', 'libelle' => 'Ascension', 'recurrent' => false],
            ['date' => '2026-05-25', 'libelle' => 'Lundi de Pentecôte', 'recurrent' => false],
            ['date' => '2026-03-20', 'libelle' => 'Korité (Aïd el-Fitr)', 'recurrent' => false],
            ['date' => '2026-05-27', 'libelle' => 'Tabaski (Aïd el-Adha)', 'recurrent' => false],
            ['date' => '2026-08-25', 'libelle' => 'Magal de Touba (approx.)', 'recurrent' => false],
            ['date' => '2026-09-21', 'libelle' => 'Tamkharit (Achoura)', 'recurrent' => false],
        ];

        foreach ($feries as $f) {
            JourFerie::updateOrCreate(
                ['date' => $f['date'], 'libelle' => $f['libelle']],
                [
                    'annee'     => 2026,
                    'recurrent' => $f['recurrent']
                ]
            );
        }

        $this->command->info('Les jours fériés du Sénégal pour 2026 ont été ajoutés avec succès !');
    }
}
