// let mymap 
// let marqueur
// let lat
// let lng
// let cercle
// let json
// let tableauMarqueurs = [];
// let marqueurs
// let posLat = 46.14939437647686;
// let posLng = 2.1972656250000004;

window.onload = () => {

    class Map {
        mymap;
        marqueur;
        posLat = 0;
        posLng = 0;
        lat;
        lng;
        cercle;
        json;
        tableauMarqueurs = [];
        marqueurs;
        view;

        constructor(posLat, posLng, view) {
            this.posLat = posLat;
            this.posLng = posLng;
            this.view = view;
            this.initMap();
            this.mymap.on('click', (e) => this.mapClickListen(e));
            this.marqueurs = L.markerClusterGroup();
            document.querySelector('.btn').addEventListener('click', (e) => this.getSearch(e))
        }

        initMap() {
            this.mymap = L.map("detailsMap").setView([this.posLat, this.posLng], this.view);
            this.layer = L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
                attribution: "&copy; les contributeurs & contributrices OpenStreetMap sous licence libre ODBl. Fond de carte par OpenStreetMap France sous licence libre CC BY-SA",
                minZoom: 1,
                maxZoom: 20
            }).addTo(this.mymap)
        }

        async mapClickListen(e) {

            // Récupère les coordonnées du clic
            let pos = e.latlng


            this.lat = pos.lat
            this.lng = pos.lng

            // Je charge une ville en fonction des coordonnées
            let ville = await this.getAdresse(this.lat, this.lng)
            document.querySelector("#search").value = ville.display_name
            document.querySelector('#filtre').value = 'adresse'
            console.log(ville)
            // Affiche le marqueur
            this.addMarker(pos);
            this.marqueur.bindPopup(`${ville.address.postcode}, ${ville.address.village}`)

        }

        async addMarker(pos) {

            // Reset du marqueur
            if (this.marqueur != undefined) {
                this.mymap.removeLayer(this.marqueur)
            }

            this.marqueur = L.marker(pos, {
                //On rend le marqueur déplaçable
                draggable: true
            })

            // ecoute du glisser déposer du marqueur
            this.marqueur.on("dragend", async function (e) {
                pos = e.target.getLatLng()
                this.lat = pos.lat
                this.lng = pos.lng
                let ville = await this.getAdresse(this.lat, this.lng)
                this.marqueur.bindPopup(`${ville.adresse.postcode}, ${ville.adresse.village}`)
            })
            this.marqueur.addTo(this.mymap)
        }

        async getAdresse(lat, lng) {
            let response = await fetch(`https://nominatim.openstreetmap.org/reverse.php?lat=${lat}&lon=${lng}&zoom=18&format=jsonv2`);
            let json = await response.json();
            return json
        }

        async getSearch(e) {
            if (this.cercle != undefined) {
                this.mymap.removeLayer(this.cercle);

            }
            if (this.marqueur != undefined) {
                this.mymap.removeLayer(this.marqueur);
                this.tableauMarqueurs.forEach(marqueur => {
                    this.mymap.removeLayer(marqueur)
                })
                this.marqueurs.clearLayers()
            }


            let recherche = encodeURI(document.querySelector('#search').value);
            let filtre = document.querySelector('#filtre').value
            let distance = document.querySelector('#distance').value
            let rayon = distance * 1000

            // J'effectue ma recherche en fonction du filtre envoyé
            if (filtre !== 'adresse') {
                let response = await fetch(`https://nominatim.openstreetmap.org/search.php?country=France&city=${recherche}&bounded=1&polygon_threshold=0&format=jsonv2`)
                this.json = await response.json();
            } else {
                let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${recherche}&format=json&polygon_svg=1`)
                this.json = await response.json();
            }
            this.lat = this.json[0].lat
            this.lng = this.json[0].lon
            let pos = [this.lat, this.lng]

            // Je dessine un cercle autour de la recherche sur un rayon défini par l'utilisateur
            this.cercle = L.circle([this.lat, this.lng], {
                color: 'blue',
                fillColor: 'blue',
                fillOpacity: 0.2,
                radius: rayon
            }).addTo(this.mymap)
            this.mymap.setView(pos, 11)

            let searchClients = await fetch(`${window.origin}/geolocalisation/api/clients/${this.lat}/${this.lng}/${distance}`);
            let clients = await searchClients.json()

            document.querySelector('.count-clients').innerHTML = (clients.length > 0) ? `${clients.length} clients dans la zone` : `aucun client dans la zone`;

            if (clients.length > 0) {
                clients.forEach(client => {
                    pos = [client.lat, client.lng]
                    this.marqueur = L.marker(pos)
                    this.marqueur.bindPopup(`${client.nom} ${client.prenom} `)
                    this.marqueurs.addLayer(this.marqueur)
                    this.tableauMarqueurs.push(this.marqueur)
                })

                let groupMarqueur = new L.featureGroup(this.tableauMarqueurs);
                this.mymap.fitBounds(groupMarqueur.getBounds().pad(0.5));
                this.mymap.addLayer(this.marqueurs)

            }

        }
    }



    // Chargement de la carte
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            posLat = position.coords.latitude;
            posLng = position.coords.longitude;
            new Map(posLat, posLng, 15);
        }, function () {
            new Map(46.14939437647686, 2.1972656250000004, 6);
        })
    }
    else {
        new Map(46.14939437647686, 2.1972656250000004, 6)
    }



}









