<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rapport {{ $typeStructure }} {{ $nomStructure }} {{ $annee }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        h1, p { margin: 0; }
    </style>
</head>
<body>
    <h1>Rapport de congés</h1>
    <p>Structure : {{ ucfirst(str_replace('_', ' ', $typeStructure)) }} - {{ $nomStructure }}</p>
    <p>Année : {{ $annee }}</p>

    <table>
        <thead>
            <tr>
                <th>Agent</th>
                <th>Matricule</th>
                <th>Structure</th>
                <th>Congés dus</th>
                <th>Absences déductibles</th>
                <th>Jours restants</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agents as $agent)
                <tr>
                    <td>{{ $agent->nom_complet }}</td>
                    <td>{{ $agent->matricule_solde }}</td>
                    <td>{{ $agent->type_affectation }} / {{ $agent->lieu_affectation }}</td>
                    <td>{{ $agent->joursCongesDus($annee) }}</td>
                    <td>{{ $agent->joursAbsencesDeductibles($annee) }}</td>
                    <td>{{ $agent->joursRestants($annee) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
