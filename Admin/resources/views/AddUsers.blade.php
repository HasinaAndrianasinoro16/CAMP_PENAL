@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Utilisateurs</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <!-- Affichage des messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter Utilisateur (excel)</div>
                    <div class="py-3"></div>
                    <form action="{{ route('ImportUsers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-9">
                                <label for="Nom" class="form-control-label">Veuiller selectionner le fichier excel/csv</label>
                                <input type="file" class="form-control" name="csv_file" class="form-control" required>
                            </div>
                        </div>
                        <div class="py-2"></div>
                        <div class="form-group">
                            <div class="col-9">
                                <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                <a href="{{ route('modelUsers') }}" class="btn btn-warning btn-lg"><i class="fas fa-file-excel"></i> Telecharger le model Excel </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
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
                                    <label for="region" class="form-control-label">Region</label>
                                    <select id="region" name="region" class="form-control">
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Position" class="form-control-label">Position</label>
                                    <select id="Position" name="position" class="form-control">
                                        <option value="1">D.R.A.P</option>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#region,#province').select2({
                placeholder: "Sélectionnez une option",
                allowClear: true
            });
        });
    </script>
@endsection
