<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des congés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, rgba(168, 85, 247, .14), transparent 24%), radial-gradient(circle at bottom right, rgba(249, 115, 22, .12), transparent 25%), linear-gradient(180deg, #fcfdff 0%, #f6f7fb 100%);
            color: #1f2937;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        a { text-decoration: none; }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: .05em;
        }
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, .88);
        }
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: #ffffff;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #f97316 100%);
        }
        .navbar .btn-outline-light {
            border-color: rgba(255, 255, 255, .72);
            color: #ffffff;
        }
        .stat-card,
        .card.card-elevated {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 20px 45px rgba(15, 23, 42, .08);
            transition: transform .25s ease, box-shadow .25s ease;
            background: #ffffff;
        }
        .stat-card:hover,
        .card.card-elevated:hover {
            transform: translateY(-2px);
            box-shadow: 0 26px 60px rgba(15, 23, 42, .12);
        }
        .stat-card-primary { background: linear-gradient(135deg, rgba(124, 58, 237, .12), rgba(236, 72, 153, .08)); }
        .stat-card-success { background: linear-gradient(135deg, rgba(16, 185, 129, .12), rgba(34, 197, 94, .08)); }
        .stat-card-warning { background: linear-gradient(135deg, rgba(245, 158, 11, .12), rgba(249, 115, 22, .08)); }
        .stat-card-info { background: linear-gradient(135deg, rgba(56, 189, 248, .12), rgba(168, 85, 247, .08)); }
        .stat-icon {
            width: 3.5rem;
            height: 3.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            font-size: 1.5rem;
        }
        .stat-icon.bg-soft-primary { background: linear-gradient(135deg, rgba(124, 58, 237, .22), rgba(236, 72, 153, .18)); color: #7c3aed; }
        .stat-icon.bg-soft-success { background: linear-gradient(135deg, rgba(16, 185, 129, .22), rgba(34, 197, 94, .18)); color: #059669; }
        .stat-icon.bg-soft-warning { background: linear-gradient(135deg, rgba(245, 158, 11, .22), rgba(249, 115, 22, .18)); color: #b45309; }
        .stat-icon.bg-soft-info { background: linear-gradient(135deg, rgba(56, 189, 248, .22), rgba(168, 85, 247, .18)); color: #0ea5e9; }
        .page-header {
            background: linear-gradient(135deg, rgba(168, 85, 247, .95), rgba(249, 115, 22, .9));
            color: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 25px 60px rgba(168, 85, 247, .18);
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, .18), transparent 20%), radial-gradient(circle at bottom left, rgba(251, 191, 36, .14), transparent 18%);
            pointer-events: none;
        }
        .page-header h1 {
            margin-bottom: .5rem;
            font-size: 2.25rem;
        }
        .page-header p {
            opacity: .95;
            max-width: 720px;
        }
        .page-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            margin-top: .75rem;
        }
        .form-control,
        .form-select {
            border-radius: .85rem;
        }
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 .2rem rgba(168, 85, 247, .24);
            border-color: #a855f7;
        }
        .table thead th {
            background: #fef3c7;
            border-bottom: 2px solid #fcd34d;
        }
        .table tbody tr:hover {
            background: #f8f0ff;
        }
        .table td,
        .table th {
            vertical-align: middle;
        }
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            border-color: transparent;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #9333ea, #f43f5e);
            border-color: transparent;
        }
        .btn-outline-secondary {
            border-radius: .85rem;
        }
        .footer {
            padding: 1.75rem 0;
            text-align: center;
            color: #6b7280;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Gestion Congés</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('agents.index') ? 'active' : '' }}" href="{{ route('agents.index') }}">Agents</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('absences.index') ? 'active' : '' }}" href="{{ route('absences.index') }}">Absences</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('conges.index') ? 'active' : '' }}" href="{{ route('conges.index') }}">Congés</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('jours-feries.index') ? 'active' : '' }}" href="{{ route('jours-feries.index') }}">Jours fériés</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('rapports.index') ? 'active' : '' }}" href="{{ route('rapports.index') }}">Rapports</a></li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                @endguest
                @auth
                    <li class="nav-item d-flex align-items-center me-2">
                        <span class="text-white opacity-75">Bonjour, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Se déconnecter</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container py-4">
    <div class="page-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
            <div>
                <h1>@yield('pageTitle', 'Bienvenue dans la gestion des congés')</h1>
                <p class="lead">@yield('pageDescription', 'Suivez les agents, gérez les absences et exportez des rapports clairs en quelques clics.')</p>
            </div>
            @hasSection('pageActions')
                <div class="page-actions align-self-center">
                    @yield('pageActions')
                </div>
            @endif
        </div>
    </div>
    @yield('content')
</div>
<footer class="footer">
    <div class="container">
        <small>Gestion Congés &copy; {{ date('Y') }}</small>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
