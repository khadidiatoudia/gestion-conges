<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RapportGenere extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type_structure', 'nom_structure', 'annee', 'chemin_fichier',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
