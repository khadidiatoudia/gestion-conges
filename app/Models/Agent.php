<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Ajouté
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Ajouté
use Illuminate\Support\Carbon; // Ajouté pour le calcul des dates
use App\Models\Absence; // Assurez-vous du nom de votre modèle
use App\Models\Conge;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'matricule_solde', 'genre', 'nb_enfants',
        'lieu_affectation', 'type_affectation', 'statut_contractuel',
        'date_prise_de_service', 'actif', 'notes',
        'jours_reportes',
    ];

    protected $casts = [
        'date_prise_de_service' => 'date',
        'actif' => 'boolean',
    ];

    // ─── Relations ───────────────────────────────────────────

    // Note : J'utilise Absence ici car c'est le nom de votre table migrée
    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class);
    }

    // ─── Accesseurs (Appends) ────────────────────────────────

    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    // ─── Logique métier ──────────────────────────────────────

    public function aDroitAuxConges(): bool
    {
        // On vérifie si la date existe pour éviter un crash
        if (!$this->date_prise_de_service) return false;

        return $this->date_prise_de_service->diffInMonths(now()) >= 12;
    }

    public function joursAcquisAnnee(int $annee = null): int
    {
        $annee = $annee ?? now()->year;
        $debut = $this->date_prise_de_service;

        if (!$debut) {
            return 0;
        }

        if ($debut->year === $annee) {
            // Prorata : 2 jours par mois (Base standard au Sénégal)
            $finAnnee = Carbon::create($annee, 12, 31);
            $mois = $debut->diffInMonths($finAnnee);
            return min((int)$mois * 2, 24);
        }

        return 24; // Droit standard annuel
    }

    public function joursAbsencesDeductibles(int $annee = null): int
    {
        $annee = $annee ?? now()->year;

        return $this->absences()
            ->where('annee', $annee)
            ->where('est_deductible', true)
            ->sum('nb_jours');
    }

    public function joursCongesDus(int $annee = null): int
    {
        $annee = $annee ?? now()->year;
        $acquis = $this->joursAcquisAnnee($annee);
        $bonusEnfants = $this->nb_enfants ?? 0;
        $reportes = $this->jours_reportes ?? 0;

        return min(72, max(0, $acquis + $bonusEnfants + $reportes));
    }

    public function joursRestants(int $annee = null): int
    {
        return max(0, $this->joursCongesDus($annee) - $this->joursAbsencesDeductibles($annee));
    }

    // ─── Scopes (Filtres) ────────────────────────────────────

    public function scopeRecherche($query, string $terme)
    {
        return $query->where(function($q) use ($terme) {
            $q->where('matricule_solde', 'like', "%{$terme}%")
              ->orWhere('nom', 'like', "%{$terme}%")
              ->orWhere('prenom', 'like', "%{$terme}%");
        });
    }

    public function scopeParStructure($query, string $type, string $nom = null)
    {
        $query->where('type_affectation', $type);
        if ($nom) $query->where('lieu_affectation', $nom);
        return $query;
    }
}
