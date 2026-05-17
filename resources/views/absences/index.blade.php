@extends('layouts.app')

@section('pageTitle','Absences')
@section('pageDescription','Liste des absences du personnel et des informations de déductibilité.')
@section('pageActions')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Retour</a>
    <a href="{{ route('absences.create') }}" class="btn btn-outline-light">Nouvelle absence</a>
@endsection

@section('content')
    <div class="card card-elevated">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Agent</th>
                        <th>Type</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Nb jours</th>
                        <th>Déductible</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absences as $absence)
                        <tr>
                            <td>{{ optional($absence->agent)->nom_complet }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $absence->type)) }}</td>
                            <td>{{ optional($absence->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ optional($absence->date_fin)->format('d/m/Y') }}</td>
                            <td>{{ $absence->nb_jours }}</td>
                            <td>{{ $absence->est_deductible ? 'Oui' : 'Non' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucune absence trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
