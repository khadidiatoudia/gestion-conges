<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
    public function index(): JsonResponse
    {
        $agents = Agent::withCount('absences')->get();

        return response()->json([
            'success' => true,
            'data' => $agents,
        ]);
    }

    public function list(Request $request)
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $query = Agent::with('absences');

        if ($request->filled('search')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('matricule_solde', 'like', "%{$request->search}%")
                    ->orWhere('nom', 'like', "%{$request->search}%")
                    ->orWhere('prenom', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('type_affectation')) {
            $query->where('type_affectation', $request->type_affectation);
        }

        if ($request->filled('lieu_affectation')) {
            $query->where('lieu_affectation', 'like', "%{$request->lieu_affectation}%");
        }

        $agents = $query->orderBy('nom')->get();

        return view('agents.index', compact('agents'));
    }
}
