@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Utilisateurs</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter les nouvealles information de l'Utilisateur</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('ModifierUsers') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Nom" class="form-control-label">Nom</label>
                                    <input type="text" id="Nom" name="name" value="{{ $users->name }}" placeholder="Entrer le nom" class="form-control">
                                    <input type="hidden" name="id" value="{{ request()->segment(2) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="matricule" class="form-control-label">Numeros matricule </label>
                                    <input type="text" id="matricule" name="matricule" value="{{ $users->matricule }}" placeholder="MAT00XXX" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="mail" class="form-control-label">Adresse electronique</label>
                                    <input type="email" id="mail" name="email" value="{{ $users->email }}" placeholder="Example@gmail.com" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="password" class="form-control-label">Mot de passe</label>
                                    <input type="password" id="password" name="password" value="{{ $users->password }}" placeholder="Entrer le mot de passe" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="province" class="form-control-label">Province</label>
                                    <select id="province" name="province" class="form-control">
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $users->is_province == $province->id ? 'selected' : '' }}>{{ $province->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Position" class="form-control-label">Position</label>
                                    <select id="Position" name="position" class="form-control">
                                        <option value="1" {{ $users->usertype == 1 ? 'selected' : '' }}>D.I.R.A.P</option>
                                        <option value="2" {{ $users->usertype == 2 ? 'selected' : '' }}>Agent du Ministère</option>
                                    </select>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer les modifications</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
