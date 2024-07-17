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
                    <div class="card-title h3">Ajouter Utilisateur</div>
                    <form action="{{ route('FormAddUsers') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Nom" class="form-control-label">Nom</label>
                                    <input type="text" id="Nom" name="name" placeholder="Entrer le nom" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="matricule" class="form-control-label">Numeros matricule </label>
                                    <input type="text" id="matricule" name="matricule" placeholder="MAT00XXX" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="mail" class="form-control-label">Adresse electronique</label>
                                    <input type="email" id="mail" name="email" placeholder="Example@gmail.com" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="password" class="form-control-label">Mot de passe</label>
                                    <input type="password" id="password" name="password" placeholder="Entrer le mot de passe" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="matricule" class="form-control-label">Numeros matricule </label>
                                    <input type="text" id="matricule" name="matricule" placeholder="MAT00XXX" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="province" class="form-control-label">Province</label>
                                    <select id="province" name="province" class="form-control">
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Position" class="form-control-label">Position</label>
                                    <select id="Position" name="position" class="form-control">
                                        <option value="1">D.I.R.A.P</option>
                                        <option value="2">Agent du Ministere</option>
                                    </select>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-success w-25 btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
