let mymap // variable pour la carte
let marqueur
let lat
let lng
let cercle
let json
let tableauMarqueurs = [];
let marqueurs
let posLat = 46.14939437647686;
let posLng = 2.1972656250000004;


window.onload = () => {


    // Chargement de la carte
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            let coordLat = position.coords.latitude;
            let coordLng = position.coords.longitude;
            mymap = L.map("detailsMap").setView([coordLat, coordLng], 6);
        }, function () {
            mymap = L.map("detailsMap").setView([posLat, posLng], 6);
        })
    } else {
        mymap = L.map("detailsMap").setView([posLat, posLng], 6);
    }
    L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
        attribution: "&copy; les contributeurs & contributrices OpenStreetMap sous licence libre ODBl. Fond de carte par OpenStreetMap France sous licence libre CC BY-SA",
        minZoom: 1,
        maxZoom: 20
    }).addTo(mymap)
    mymap.on('click', mapClickListen)
    marqueurs = L.markerClusterGroup();

    document.querySelector('.btn').addEventListener('click', getSearch)


}

async function mapClickListen(e) {
    // Récuèpre les coordonnées du clic
    let pos = e.latlng

    lat = pos.lat
    lng = pos.lng

    // Je charge une ville en fonction des coordonnées
    let ville = await getAdresse(lat, lng)
    document.querySelector("#search").value = ville.display_name
    document.querySelector('#filtre').value = 'adresse'

    // Affiche le marqueur
    addMarker(pos);
    marqueur.bindPopup(`${ville.adresse.postcode}, ${ville.adresse.village}`)

}

async function addMarker(pos) {

    // Reset du marqueur
    if (marqueur != undefined) {
        mymap.removeLayer(marqueur)
    }

    marqueur = L.marker(pos, {
        //On rend le marqueur déplaçable
        draggable: true
    })

    // ecoute du glisser déposer du marqueur
    marqueur.on("dragend", async function (e) {
        pos = e.target.getLatLng()
        lat = pos.lat
        lng = pos.lng
        let ville = await getAdresse(lat, lng)
        marqueur.bindPopup(`${ville.adresse.postcode}, ${ville.adresse.village}`)
    })
    marqueur.addTo(mymap)
}


// Permet de faire la requête pour récupérer l'adresse en fonction des coordonnées
async function getAdresse(lat, lng) {
    let response = await fetch(`https://nominatim.openstreetmap.org/reverse.php?lat=${lat}&lon=${lng}&zoom=18&format=jsonv2`);
    let json = await response.json();
    return json
}

// Permet de récupérer les informations pour la recherche et les afficher sur la map
async function getSearch() {

    if (cercle != undefined) {
        mymap.removeLayer(cercle);

    }
    if (marqueur != undefined) {
        mymap.removeLayer(marqueur);
        tableauMarqueurs.forEach(marqueur => {
            mymap.removeLayer(marqueur)
        })
        marqueurs.clearLayers()
    }


    let recherche = encodeURI(document.querySelector('#search').value);
    let filtre = document.querySelector('#filtre').value
    let distance = document.querySelector('#distance').value
    let rayon = distance * 1000


    // J'effectue ma recherche en fonction du filtre envoyé
    if (filtre !== 'adresse') {
        let response = await fetch(`https://nominatim.openstreetmap.org/search.php?country=France&city=${recherche}&bounded=1&polygon_threshold=0&format=jsonv2`)
        json = await response.json();
    } else {
        let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${recherche}&format=json&polygon_svg=1`)
        json = await response.json();
    }

    lat = json[0].lat
    lng = json[0].lon
    let pos = [lat, lng]

    // Je dessine un cercle autour de la recherche sur un rayon défini par l'utilisateur
    cercle = L.circle([lat, lng], {
        color: 'blue',
        fillColor: 'blue',
        fillOpacity: 0.2,
        radius: rayon
    }).addTo(mymap)

    mymap.setView(pos, 11)

    let searchClients = await fetch(`${window.origin}/geolocalisation/api/clients/${lat}/${lng}/${distance}`);
    let clients = await searchClients.json()

    document.querySelector('.count-clients').innerHTML = (clients.length > 0) ? `${clients.length} clients dans la zone` : `aucun client dans la zone`

    if (clients.length > 0) {

        clients.forEach(client => {
            pos = [client.lat, client.lng]
            marqueur = L.marker(pos)
            marqueur.bindPopup(`${client.nom} ${client.prenom}`)
            marqueurs.addLayer(marqueur)
            tableauMarqueurs.push(marqueur)
        })

        let groupMarqueur = new L.featureGroup(tableauMarqueurs);
        mymap.fitBounds(groupMarqueur.getBounds().pad(0.5));
        mymap.addLayer(marqueurs)

    }








}







