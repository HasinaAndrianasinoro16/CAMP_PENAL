@extends('Dashboard')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter un nouveau camp penal</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ route('form_camp_penal') }}" method="post">
                                @csrf
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="Nom" class="form-control-label">Nom</label>
                                            <input type="text" id="Nom" name="nom" placeholder="Entrer le nom" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="superficie" class="form-control-label">Superficie (m<sup>2</sup>)</label>
                                            <input type="number" min="1" step="0.1" id="superficie" name="superficie" placeholder="4,1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="province" class="form-control-label">Province</label>
                                            <select id="province" name="province" class="form-control">
                                                @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="lat" class="form-control-label">Lattitude</label>
                                                    <input type="text" id="lat" name="lat" placeholder="-0.5978" class="form-control">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="lng" class="form-control-label">longitude</label>
                                                    <input type="text" id="lng" name="lng" placeholder="1.125" class="form-control">
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
        var map = L.map('map').setView([-20.0000, 47.0000], 13);

        // Ajout de la couche de tuiles OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Gestionnaire d'événements pour les clics sur la carte
        map.on('click', onMapClick);

        // Fonction pour centrer la carte sur la position de l'utilisateur
        function centerMapOnUserPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var userLatLng = [lat, lng];

            // Centrer la carte sur la position de l'utilisateur
            map.setView(userLatLng, 13);

            // Ajouter un marqueur à la position de l'utilisateur
            L.marker(userLatLng).addTo(map)
                .bindPopup("Vous êtes ici.")
                .openPopup();

            // Mettre à jour les inputs avec la position de l'utilisateur
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        }

        // Gestionnaire d'erreurs pour la géolocalisation
        function handleGeolocationError(error) {
            console.error("Erreur de géolocalisation : " + error.message);
        }

        // Demander la position de l'utilisateur
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(centerMapOnUserPosition, handleGeolocationError);
        } else {
            console.error("La géolocalisation n'est pas supportée par ce navigateur.");
        }
    </script>
@endsection
