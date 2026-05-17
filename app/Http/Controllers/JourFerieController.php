<?php

namespace App\Http\Controllers;

use App\Models\JourFerie;
use Illuminate\Http\JsonResponse;

class JourFerieController extends Controller
{
    public function index(): JsonResponse
    {
        $joursFeries = JourFerie::orderBy('date')->get();

        return response()->json([
            'success' => true,
            'data' => $joursFeries,
        ]);
    }

    public function list()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $joursFeries = JourFerie::orderBy('date')->get();

        return view('jours-feries.index', compact('joursFeries'));
    }
}
