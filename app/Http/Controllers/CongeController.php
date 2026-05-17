<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Agent;
use App\Services\WorkingDaysCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index(): JsonResponse
    {
        $conges = Conge::with('agent')->get();

        return response()->json([
            'success' => true,
            'data' => $conges,
        ]);
    }

    public function list()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $conges = Conge::with('agent')->orderBy('date_debut')->get();

        return view('conges.index', compact('conges'));
    }

    public function create()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $agents = Agent::orderBy('nom')->get();
        return view('conges.create', compact('agents'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $data = $request->validate([
            'agent_id' => ['required', 'exists:agents,id'],
            'date_debut' => ['required', 'date'],
            'nb_jours' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:normale,maternite,accident_travail,maladie,autre'],
            'statut' => ['required', 'in:en_attente,approuve,refuse'],
            'date_cessation_service' => ['nullable', 'date'],
            'numero_autorisation' => ['nullable', 'string'],
            'observations' => ['nullable', 'string'],
        ]);

        $dateDebut = \Carbon\Carbon::parse($data['date_debut']);
        $data['date_fin'] = WorkingDaysCalculator::addWorkingDays($dateDebut, $data['nb_jours'])->toDateString();
        $data['date_reprise_service'] = WorkingDaysCalculator::nextWorkingDay(\Carbon\Carbon::parse($data['date_fin']))->toDateString();
        $data['annee'] = $dateDebut->year;

        Conge::create($data);

        return redirect()->route('conges.index')->with('success', 'Congé enregistré et calculé avec succès.');
    }
}
