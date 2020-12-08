let mymap // variable pour la carte
let marqueur
let lat
let lng
let cercle
let json

window.onload = () => {

    // Chargement de la carte
    mymap = L.map("detailsMap").setView([46.14939437647686, 2.1972656250000004], 6);
    L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
        attribution: "&copy; les contributeurs & contributrices OpenStreetMap sous licence libre ODBl. Fond de carte par OpenStreetMap France sous licence libre CC BY-SA",
        minZoom: 1,
        maxZoom: 20
    }).addTo(mymap)
    mymap.on('click', mapClickListen)

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

    // Affiche le marqueur
    addMarker(pos);
    marqueur.bindPopup(`${ville.address.postcode}, ${ville.address.village}`)

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
        document.querySelector("#search").value = ville.display_name
        marqueur.bindPopup(`${ville.address.postcode}, ${ville.address.village}`)
    })
    marqueur.addTo(mymap)
}


// Permet de faire la requête pour récupérer l'adresse en fonction des coordonnées
async function getAdresse(lat, lng) {
    let response = await fetch(`https://nominatim.openstreetmap.org/reverse.php?lat=${lat}&lon=${lng}&zoom=18&format=jsonv2`);
    let json = await response.json();
    return json
}

async function getSearch() {

    if (cercle != undefined) {
        mymap.removeLayer(cercle);

    }
    if (marqueur != undefined) {
        mymap.removeLayer(marqueur);
    }

    let recherche = document.querySelector('#search').value
    let filtre = document.querySelector('#filtre').value
    let distance = document.querySelector('#distance').value

    // J'effectue ma recherche en fonction du filtre envoyé
    if (filtre !== 'address') {
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
        radius: (distance) * 1000
    }).addTo(mymap)

    // Si je cherche une adresse précise, alors j'inscris un marqueur
    if (filtre === 'address') {
        addMarker(pos)
    }
    mymap.setView(pos, 11)














    // document.querySelector("#ville").addEventListener("blur", getCity)

    // dessiner un cercle de 5km de diamètre
    // rayon 2500m
    // let cercle = L.circle([48.852969, 2.349903], {
    //     color: 'blue',
    //     fillColor: 'blue',
    //     fillOpacity: 0.2,
    //     radius: 2500
    // }).addTo(mymap)
    // cercle.bindPopup('Ville de Paris')

    // let triangle = L.polygon([
    //     [48.85779, 2.3392724],
    //     [48.852630, 2.3523187],
    //     [48.86, 2.35223293]
    // ]).addTo(mymap)
    // triangle.bindPopup("Triangle")




    // On initialise une requête Ajax
    // let response = await fetch(`https://nominatim.openstreetmap.org/search?q=${cp}&format=json&addressdetails=0&limit=1&polygon_svg=1`)
    // let response = await fetch(`https://nominatim.openstreetmap.org/search.php?country=France&city=${recherche}&polygon_geojson=1&bounded=1&polygon_threshold=0&format=jsonv2`)
    // let json = await response.json();

    // let parDepartement = L.geoJSON(json[0].geojson, {
    //     style: {
    //         "color": 'blue',
    //         "opcaity": 1,
    //         "filleColor": 'blue',
    //         "fillOpacity": 0.2,
    //     }
    // }).addTo(mymap)

    // let lat = json[0].lat
    // let lon = json[0].lon

    // document.querySelector('#lat').value = lat
    // document.querySelector('#lon').value = lon

    // let pos = [lat, lon]
    // addMarker(pos)

    // mymap.setView(pos, 11)
}

