<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\JourFerieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Models\Agent;
use App\Models\Absence;
use App\Models\Conge;
use App\Models\JourFerie;

Route::middleware([
	\Illuminate\Cookie\Middleware\EncryptCookies::class,
	\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
	\Illuminate\Session\Middleware\StartSession::class,
])->group(function () {
	Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/agents', [AgentController::class, 'list'])->name('agents.index');
	Route::get('/absences', [AbsenceController::class, 'list'])->name('absences.index');
	Route::get('/absences/create', [AbsenceController::class, 'create'])->name('absences.create');
	Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store');
	Route::get('/conges', [CongeController::class, 'list'])->name('conges.index');
	Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
	Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
	Route::get('/jours-feries', [JourFerieController::class, 'list'])->name('jours-feries.index');
	Route::get('/rapports', [ReportController::class, 'index'])->name('rapports.index');
	Route::get('/rapports/pdf', [ReportController::class, 'exportPdf'])->name('rapports.pdf');
});

Route::get('/api/agents', [AgentController::class, 'index']);
Route::get('/api/absences', [AbsenceController::class, 'index']);
Route::get('/api/conges', [CongeController::class, 'index']);
Route::get('/api/jours-feries', [JourFerieController::class, 'index']);
