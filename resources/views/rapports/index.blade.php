@extends('layouts.app')

@section('pageTitle','Rapports')
@section('pageDescription','Filtrez les agents par structure et exportez le rapport en PDF.')
@section('pageActions')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Retour au tableau de bord</a>
@endsection

@section('content')
    <div class="card card-elevated mb-4">
        <div class="card-body">
            <form class="row g-3" method="GET" action="{{ route('rapports.index') }}">
                <div class="col-md-3">
                    <label class="form-label">Type de structure</label>
                    <select class="form-select" name="type_structure">
                        <option value="">Tous</option>
                        <option value="direction" {{ request('type_structure') === 'direction' ? 'selected' : '' }}>Direction</option>
                        <option value="ufr" {{ request('type_structure') === 'ufr' ? 'selected' : '' }}>UFR</option>
                        <option value="rectorat" {{ request('type_structure') === 'rectorat' ? 'selected' : '' }}>Rectorat</option>
                        <option value="vice_recteur" {{ request('type_structure') === 'vice_recteur' ? 'selected' : '' }}>Vice-recteur</option>
                        <option value="tous" {{ request('type_structure') === 'tous' ? 'selected' : '' }}>Tous</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nom de structure</label>
                    <input type="text" class="form-control" name="nom_structure" value="{{ request('nom_structure') }}" placeholder="Ex: UFR SET">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Année</label>
                    <input type="number" class="form-control" name="annee" value="{{ request('annee', now()->year) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('rapports.pdf', request()->all()) }}" class="btn btn-outline-secondary">Exporter en PDF</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-elevated">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Agent</th>
                        <th>Matricule</th>
                        <th>Structure</th>
                        <th>Jours dus</th>
                        <th>Absences déductibles</th>
                        <th>Jours restants</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>{{ $agent->nom_complet }}</td>
                            <td>{{ $agent->matricule_solde }}</td>
                            <td>{{ $agent->type_affectation }} / {{ $agent->lieu_affectation }}</td>
                            <td>{{ $agent->joursCongesDus($annee) }}</td>
                            <td>{{ $agent->joursAbsencesDeductibles($annee) }}</td>
                            <td>{{ $agent->joursRestants($annee) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucun agent ne correspond aux filtres.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
