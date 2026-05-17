@extends('layouts.app')

@section('pageTitle','Jours fériés')
@section('pageDescription','Consultez les jours fériés enregistrés et préparez votre planning.')
@section('pageActions')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Retour</a>
@endsection

@section('content')
    <div class="card card-elevated">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Libellé</th>
                        <th>Année</th>
                        <th>Récurrent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($joursFeries as $jourFerie)
                        <tr>
                            <td>{{ optional($jourFerie->date)->format('d/m/Y') }}</td>
                            <td>{{ $jourFerie->libelle }}</td>
                            <td>{{ $jourFerie->annee }}</td>
                            <td>{{ $jourFerie->recurrent ? 'Oui' : 'Non' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Aucun jour férié trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
