@extends('Dashboard')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <style>
        #map{
            height: 500px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp pénal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Modifier un camp pénal</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('ModifierCamp') }}" method="post">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="Nom" class="form-control-label">Nom</label>
                                            <input type="text" id="Nom" name="nom" value="{{ $camps->nom }}" placeholder="Entrer le nom" class="form-control">
                                            <input type="hidden" id="id" name="id" value="{{ request()->segment(2) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="province" class="form-control-label">Province</label>
                                            <select id="province" name="province" class="form-control">
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}" {{ $province->id == $camps->id_province ? 'selected' : '' }}>{{ $province->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="sol" class="form-control-label">Type de sol</label>
                                            <select id="sol" name="sol" class="form-control">
                                                @foreach($sols as $sol)
                                                    <option value="{{ $sol->id }}" {{ $sol->id == $camps->id_sol ? 'selected' : '' }}>{{ $sol->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="lat" class="form-control-label">Latitude</label>
                                                    <input type="text" id="lat" name="lat" value="{{ $camps->lat }}" placeholder="-0.5978" class="form-control">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="lng" class="form-control-label">Longitude</label>
                                                    <input type="text" id="lng" name="lng" value="{{ $camps->lng }}" placeholder="1.125" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2"></div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script>
        var popup = L.popup();

        // Fonction pour afficher sur la carte les coordonnées du point cliqué
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Vous avez cliqué sur les coordonnées " + e.latlng.toString())
                .openOn(map);

            // Mettre à jour les inputs avec les coordonnées cliquées
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
        }

        // Initialisation de la carte
        var map = L.map('map').setView([{{ $camps->lat }}, {{ $camps->lng }}], 13);

        // Ajout de la couche de tuiles OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ajouter un marqueur à la position du camp
        var marker = L.marker([{{ $camps->lat }}, {{ $camps->lng }}]).addTo(map)
            .bindPopup("Ici se situe le camp.")
            .openPopup();

        // Gestionnaire d'événements pour les clics sur la carte
        map.on('click', onMapClick);
    </script>
@endsection
