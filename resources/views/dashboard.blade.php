@extends('layouts.app')

@section('pageTitle','Tableau de bord')
@section('pageDescription','Vue d\'ensemble des effectifs, absences et congés de votre équipe.')
@section('pageActions')
    <a href="{{ route('agents.index') }}" class="btn btn-outline-light">Agents</a>
    <a href="{{ route('absences.index') }}" class="btn btn-outline-light">Absences</a>
    <a href="{{ route('conges.index') }}" class="btn btn-outline-light">Congés</a>
    <a href="{{ route('rapports.index') }}" class="btn btn-outline-light">Rapports</a>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-primary h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-soft-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Agents</h6>
                        <h2 class="mb-0">{{ $agents }}</h2>
                        <small class="text-muted">Total des collaborateurs</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-success h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-soft-success">
                        <i class="bi bi-calendar-x-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Absences</h6>
                        <h2 class="mb-0">{{ $absences }}</h2>
                        <small class="text-muted">Demandes enregistrées</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-warning h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-soft-warning">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Congés</h6>
                        <h2 class="mb-0">{{ $conges }}</h2>
                        <small class="text-muted">Congés planifiés</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-info h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-soft-info">
                        <i class="bi bi-sun-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Jours fériés</h6>
                        <h2 class="mb-0">{{ $joursFeries }}</h2>
                        <small class="text-muted">Jours dans le calendrier</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-8">
            <div class="card card-elevated h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Actions rapides</h5>
                    <p class="text-muted">Accédez directement aux sections les plus utilisées du portail.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="{{ route('agents.index') }}" class="btn btn-outline-primary w-100 py-3 text-start">
                                <strong>Gérer les agents</strong>
                                <div class="small text-muted">Ajouter, modifier ou consulter vos collaborateurs.</div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('absences.index') }}" class="btn btn-outline-success w-100 py-3 text-start">
                                <strong>Voir les absences</strong>
                                <div class="small text-muted">Suivre les demandes et validations.</div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('conges.index') }}" class="btn btn-outline-warning w-100 py-3 text-start">
                                <strong>Consulter les congés</strong>
                                <div class="small text-muted">Planifier les périodes de repos.</div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('rapports.index') }}" class="btn btn-outline-info w-100 py-3 text-start">
                                <strong>Générer un rapport</strong>
                                <div class="small text-muted">Créer un rapport de structure en PDF.</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-elevated h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">Conseil</h5>
                    <p class="text-muted">Commencez par ajouter des agents, puis renseignez les absences et congés pour que le tableau de bord affiche des données utiles.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-primary">Agents</span>
                        <span class="badge bg-success">Absences</span>
                        <span class="badge bg-warning text-dark">Congés</span>
                        <span class="badge bg-info text-dark">Rapports</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
