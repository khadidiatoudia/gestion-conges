@extends('layouts.app')

@section('pageTitle','Connexion')
@section('pageDescription','Connectez-vous pour accéder au tableau de bord et gérer congés, absences et rapports.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card card-elevated overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-primary text-white p-4 d-flex flex-column justify-content-center">
                        <div>
                            <h3 class="fw-bold">Bienvenue</h3>
                            <p class="mb-0">Accédez à vos rapports et à la gestion du personnel.</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('login.submit') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 text-muted small">
                Utilisez <strong>admin@univ.com</strong> / <strong>password</strong> ou <strong>gestionnaire@univ.com</strong> / <strong>password</strong>.
            </div>
        </div>
    </div>
@endsection
