<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Absence;
use App\Models\Conge;
use App\Models\JourFerie;

class DashboardController extends Controller
{
    public function index()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('dashboard', [
            'agents' => Agent::count(),
            'absences' => Absence::count(),
            'conges' => Conge::count(),
            'joursFeries' => JourFerie::count(),
        ]);
    }
}
