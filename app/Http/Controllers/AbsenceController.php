<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Agent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index(): JsonResponse
    {
        $absences = Absence::with('agent')->get();

        return response()->json([
            'success' => true,
            'data' => $absences,
        ]);
    }

    public function list(Request $request)
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $absences = Absence::with('agent')->orderBy('date_debut')->get();

        return view('absences.index', compact('absences'));
    }

    public function create()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $agents = Agent::orderBy('nom')->get();
        return view('absences.create', compact('agents'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $data = $request->validate([
            'agent_id' => ['required', 'exists:agents,id'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'nb_jours' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:normale,mariage,bapteme,deces_proche,autre_exceptionnelle'],
            'numero_autorisation' => ['nullable', 'string'],
            'observations' => ['nullable', 'string'],
        ]);

        Absence::create($data);

        return redirect()->route('absences.index')->with('success', 'Absence enregistrée avec succès.');
    }
}
