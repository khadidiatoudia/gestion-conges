<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\RapportGenere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Agent::with('absences');

        if ($request->filled('type_structure')) {
            $query->where('type_affectation', $request->type_structure);
        }

        if ($request->filled('nom_structure')) {
            $query->where('lieu_affectation', 'like', "%{$request->nom_structure}%");
        }

        $agents = $query->orderBy('type_affectation')->orderBy('lieu_affectation')->get();

        return view('rapports.index', [
            'agents' => $agents,
            'typeStructure' => $request->type_structure,
            'nomStructure' => $request->nom_structure,
            'annee' => $request->input('annee', now()->year),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $query = Agent::with('absences');

        if ($request->filled('type_structure')) {
            $query->where('type_affectation', $request->type_structure);
        }

        if ($request->filled('nom_structure')) {
            $query->where('lieu_affectation', 'like', "%{$request->nom_structure}%");
        }

        $agents = $query->orderBy('type_affectation')->orderBy('lieu_affectation')->get();
        $annee = $request->input('annee', now()->year);
        $typeStructure = $request->type_structure ?: 'tous';
        $nomStructure = $request->nom_structure ?: 'Tous';

        $filename = sprintf('rapport_%s_%s_%s.pdf', $typeStructure, str_replace(' ', '_', $nomStructure), $annee);
        $filename = str_replace(['/', '\\'], '-', $filename);

        $pdf = Pdf::loadView('rapports.pdf', [
            'agents' => $agents,
            'typeStructure' => $typeStructure,
            'nomStructure' => $nomStructure,
            'annee' => $annee,
        ]);

        $storagePath = 'rapports/'.$filename;
        Storage::disk('public')->put($storagePath, $pdf->output());

        RapportGenere::create([
            'user_id' => auth()->id() ?? 1,
            'type_structure' => $typeStructure,
            'nom_structure' => $nomStructure,
            'annee' => $annee,
            'chemin_fichier' => $storagePath,
        ]);

        return $pdf->download($filename);
    }
}
