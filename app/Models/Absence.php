<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'date_debut', 'date_fin', 'nb_jours',
        'annee', 'type', 'est_deductible',
        'numero_autorisation', 'observations',
    ];

    protected $casts = [
        'date_debut'     => 'date',
        'date_fin'       => 'date',
        'est_deductible' => 'boolean',
    ];

    // Types NON déductibles (Permissions exceptionnelles au Sénégal)
    const TYPES_EXCEPTIONNELS = ['mariage', 'bapteme', 'deces_proche', 'autre_exceptionnelle'];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * Logique automatique au moment de la création/modification
     */
    protected static function booted(): void
    {
        static::creating(function (Absence $absence) {
            // 1. Définir si c'est déductible selon le type
            if (in_array($absence->type, self::TYPES_EXCEPTIONNELS)) {
                $absence->est_deductible = false;
            } else {
                $absence->est_deductible = true;
            }

            // 2. Déduire l'année automatiquement à partir de la date de début
            if ($absence->date_debut) {
                $absence->annee = $absence->date_debut->year;
            }
        });

        // 3. Après création → Déclencher le recalcul (si vous utilisez une table de soldes)
        static::created(function (Absence $absence) {
            // Optionnel : Si vous avez un modèle pour suivre les soldes annuels
            // $solde = Solde::where('agent_id', $absence->agent_id)->where('annee', $absence->annee)->first();
            // $solde?->recalculer();
        });
    }
}
