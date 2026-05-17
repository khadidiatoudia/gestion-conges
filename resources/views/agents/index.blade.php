@extends('layouts.app')

@section('pageTitle','Agents')
@section('pageDescription','Liste des agents et état des congés pour chaque collaborateur.')
@section('pageActions')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Retour</a>
@endsection

@section('content')
    <div class="card card-elevated">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Matricule</th>
                        <th>Affectation</th>
                        <th>Date prise de service</th>
                        <th>Enfants</th>
                        <th>Congés dus</th>
                        <th>Absences déductibles</th>
                        <th>Jours restants</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>{{ $agent->nom_complet }}</td>
                            <td>{{ $agent->matricule_solde }}</td>
                            <td>{{ $agent->lieu_affectation }} / {{ $agent->type_affectation }}</td>
                            <td>{{ optional($agent->date_prise_de_service)->format('d/m/Y') }}</td>
                            <td>{{ $agent->nb_enfants }}</td>
                            <td>{{ $agent->joursCongesDus() }}</td>
                            <td>{{ $agent->joursAbsencesDeductibles() }}</td>
                            <td>{{ $agent->joursRestants() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">Aucun agent trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
