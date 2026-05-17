@extends('layouts.app')

@section('pageTitle','Nouvelle absence')
@section('pageDescription','Enregistrez une absence et précisez si elle est déductible.')
@section('pageActions')
    <a href="{{ route('absences.index') }}" class="btn btn-outline-light">Retour à la liste</a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8">
            <div class="card card-elevated">
                <div class="card-header bg-primary text-white rounded-top">Nouvelle absence</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('absences.store') }}">
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
                                <label class="form-label">Date fin</label>
                                <input type="date" name="date_fin" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre de jours</label>
                            <input type="number" name="nb_jours" class="form-control" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select">
                                <option value="normale">Normale</option>
                                <option value="mariage">Mariage</option>
                                <option value="bapteme">Baptême</option>
                                <option value="deces_proche">Décès proche</option>
                                <option value="autre_exceptionnelle">Autre (exceptionnelle)</option>
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
                        <a href="{{ route('absences.index') }}" class="btn btn-secondary ms-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
