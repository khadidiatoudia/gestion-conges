@extends('layouts.app')

@section('pageTitle','Congés')
@section('pageDescription','Visualisez l’ensemble des demandes de congés et leur statut.')
@section('pageActions')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Retour</a>
    <a href="{{ route('conges.create') }}" class="btn btn-outline-light">Nouvelle demande</a>
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
                        <th>Date cessation</th>
                        <th>Date reprise</th>
                        <th>Nb jours</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conges as $conge)
                        <tr>
                            <td>{{ optional($conge->agent)->nom_complet }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $conge->type)) }}</td>
                            <td>{{ optional($conge->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ optional($conge->date_fin)->format('d/m/Y') }}</td>
                            <td>{{ optional($conge->date_cessation_service)->format('d/m/Y') }}</td>
                            <td>{{ optional($conge->date_reprise_service)->format('d/m/Y') }}</td>
                            <td>{{ $conge->nb_jours }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $conge->statut)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Aucun congé trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
