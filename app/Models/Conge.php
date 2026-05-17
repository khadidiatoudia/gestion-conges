<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'date_debut', 'date_fin', 'date_cessation_service', 'date_reprise_service', 'nb_jours',
        'annee', 'type', 'statut',
        'numero_autorisation', 'observations',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_cessation_service' => 'date',
        'date_reprise_service' => 'date',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
