

NEW_CLIENTS = document.getElementById('nouveau-clients');
NBR_CLIENTS_YEAR = document.getElementById('nombre-clients-an');
CLIENTS_TEL_MAIL = document.getElementById('clients-telephone-mail');
CONTACT_UTILISATEUR = document.getElementById('nombre-contact-utilisateur');
RDV_UTILISATEUR = document.getElementById('nombre-rdv-utilisateur');

let nombreClients = [];
let annees = [];
async function fetchUrl(url) {
    let response = await fetch(`${window.origin}/${url}`);
    let json = await response.json();
    return json
}

// Requête pour récupérer la liste des nouveaux clients regroupés par années
async function ListeNouveauClients() {

    return fetchUrl(`tableau-de-bord/api/nouveaux-clients`)

}
ListeNouveauClients().then(function (clients) {

    nombreClients = [];
    annees = []

    clients.forEach(client => {
        nombreClients.push(client.nbrClients);
        annees.push(client.annee)
    });

    let trace1 = {
        x: annees,
        y: nombreClients,
        type: 'bar',
        name: 'Nombre de nouveaux clients',
        marker: {
            color: 'rgb(49,130,189)',
            opacity: 0.7,
        },

    };

    let data = [trace1];

    let layout = {
        title: 'Nouveaux clients par an',
        xaxis: {
            tickangle: -45
        },
        barmode: 'group',
        xaxis: {
            type: 'category'
        },


    };
    let config = { responsive: true }

    Plotly.newPlot(NEW_CLIENTS, data, layout, config);
})


// Récupère la liste du nombre de clients par an
async function nombreClientsParAn(tableauAnnees) {

    return fetchUrl(`tableau-de-bord/api/nombre-clients-par-an/${tableauAnnees}`)

}
let nombreAnneAnalyse = document.querySelector('#nombre-annees').value;
let anneeEnCours = new Date().getFullYear();
let tableauAnnees = []
let tableauAnneeUrl

for (i = nombreAnneAnalyse - 1; i >= 0; i--) {
    tableauAnnees.push(anneeEnCours - i);
}
tableauAnneeUrl = tableauAnnees.join('-');


function graphiqueNombreClientsParAn(clients) {
    nombreClients = [];
    annees = []

    clients.forEach(client => {
        nombreClients.push(client.nombre);
        annees.push(client.annee)
    })
    let trace1 = {
        x: annees,
        y: nombreClients,
        mode: 'lines+markers',
        connectgaps: true
    };

    let data = [trace1];

    let layout = {
        title: 'Nombre de clients par an',
        showlegend: false,
        xaxis: {
            type: 'category',
        },
        yaxis: {
            type: 'linear',
        }
    };

    let config = { responsive: true }

    Plotly.newPlot(NBR_CLIENTS_YEAR, data, layout, config);
}
nombreClientsParAn(tableauAnneeUrl).then(function (clients) {
    graphiqueNombreClientsParAn(clients);
})
document.querySelector('#nombre-annees').addEventListener('change', function () {

    tableauAnnees = []
    nombreAnneAnalyse = this.value;

    for (i = nombreAnneAnalyse - 1; i >= 0; i--) {
        tableauAnnees.push(anneeEnCours - i);
    }
    tableauAnneeUrl = tableauAnnees.join('-');

    nombreClientsParAn(tableauAnneeUrl).then(function (clients) {
        graphiqueNombreClientsParAn(clients);
    })
})


// Nombre de clients sans téléphone ou email ou les deux
async function nombreClientSansTelSansMail() {
    return fetchUrl(`tableau-de-bord/api/sans-tel-sans-email`);
}
nombreClientSansTelSansMail().then(function (info) {
    let data = [
        {
            x: info,
            y: ['sans tél', 'sans email', 'les deux'],
            type: 'bar',
            orientation: 'h'
        }
    ];
    let layout = {
        title: 'Nombre clients sans téléphone ou email',
        xaxis: {
            tickangle: -45,
            rangemode: "tozero"
        },
        barmode: 'group'
    };
    let config = { responsive: true }

    Plotly.newPlot(CLIENTS_TEL_MAIL, data, layout, config);

})

// Nombre de contact de clients par utilisateur sur l'année en cours
async function nombreContactParUtilisateur() {
    return fetchUrl('tableau-de-bord/api/contact-par-utilisateur');
} nombreContactParUtilisateur().then(function (info) {
    let nomUtilisateur = [];
    let nombreContact = [];
    let nombreTotal = 0;

    info.forEach(utilisateur => {
        nomUtilisateur.push(`${utilisateur.nom} ${utilisateur.prenom}`)
        nombreContact.push(utilisateur.nombre)
        nombreTotal += parseInt(utilisateur.nombre)
    })

    let data = [{
        type: 'bar',
        x: nombreContact,
        y: nomUtilisateur,
        orientation: 'h'
    }];

    let layout = {
        title: `Nombre de contacts clients par utilisateur sur ${new Date().getFullYear()} | Total ${nombreTotal}`,
        xaxis: {
            rangemode: "tozero"
        },
    }
    let config = { responsive: true }

    Plotly.newPlot(CONTACT_UTILISATEUR, data, layout, config);
})


// Nombre de rendez-vous clients par utilisateur sur l'année en cours
async function nombreRdvParUtilisateur() {
    return fetchUrl('tableau-de-bord/api/rdv-par-utilisateur');
} nombreRdvParUtilisateur().then(function (info) {

    let nomUtilisateur = [];
    let nombreContact = [];
    let nombreTotal = 0;

    info.forEach(utilisateur => {
        nomUtilisateur.push(`${utilisateur.nom} ${utilisateur.prenom}`)
        nombreContact.push(utilisateur.nombre)
        nombreTotal += parseInt(utilisateur.nombre)
    })

    let data = [{
        type: 'bar',
        x: nombreContact,
        y: nomUtilisateur,
        orientation: 'h'
    }];

    let layout = {
        title: `Nombre de rendez-vous clients par utilisateur sur ${new Date().getFullYear()} | Total ${nombreTotal}`,
        xaxis: {
            rangemode: "tozero"
        },
    }
    let config = { responsive: true }

    Plotly.newPlot(RDV_UTILISATEUR, data, layout, config);

})









