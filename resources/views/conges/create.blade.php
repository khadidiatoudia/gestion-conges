@extends('layouts.app')

@section('pageTitle','Nouvelle demande de congé')
@section('pageDescription','Créez une demande de congé et enregistrez-la rapidement.')
@section('pageActions')
    <a href="{{ route('conges.index') }}" class="btn btn-outline-light">Retour à la liste</a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8">
            <div class="card card-elevated">
                <div class="card-header bg-primary text-white rounded-top">Nouvelle demande de congé</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('conges.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Agent</label>
                            <select name="agent_id" class="form-select" required>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->nom_complet }} ({{ $agent->matricule_solde }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date début</label>
                                <input type="date" name="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre de jours ouvrables</label>
                                <input type="number" name="nb_jours" class="form-control" min="1" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select">
                                <option value="normale">Normale</option>
                                <option value="maternite">Maternité</option>
                                <option value="accident_travail">Accident travail</option>
                                <option value="maladie">Maladie</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="en_attente">En attente</option>
                                <option value="approuve">Approuvé</option>
                                <option value="refuse">Refusé</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Numéro d'autorisation</label>
                            <input type="text" name="numero_autorisation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Observations</label>
                            <textarea name="observations" class="form-control" rows="4"></textarea>
                        </div>

                        <button class="btn btn-primary">Enregistrer</button>
                        <a href="{{ route('conges.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
