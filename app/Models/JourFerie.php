<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Ajouté
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon; // Ajouté

// app/Models/JourFerie.php

class JourFerie extends Model
{
    use HasFactory;

    protected $table = 'jours_feries';

    protected $fillable = ['date', 'libelle', 'annee', 'recurrent'];
    protected $casts    = ['date' => 'date', 'recurrent' => 'boolean'];

    public static function estFerie(Carbon $date): bool
    {
        return self::where('date', $date->toDateString())->exists();
    }
}

