document.addEventListener('DOMContentLoaded', function () {

    let addCustomer = document.querySelector('#page-gestion .add-customer');
    let gestionSearch = document.querySelector('#gestion-search');
    let searchResult = document.querySelector('.search-result');
    let searchClose = document.querySelector('.search-close');
    let modal = document.querySelector('.modal');
    M.Modal.init(modal);
    let json;
    let response;




    function resetModal() {

        if (document.querySelector('.modal-content .last-contact')) {
            document.querySelector('.modal-content .last-contact').remove();
        }
        if (document.querySelector('.modal-content .rendez-vous')) {
            document.querySelector('.modal-content .rendez-vous').remove();
        }
    }

    // rend le formulaire pour créer un client visible ou invisible
    addCustomer.addEventListener('click', function () {
        let newCustomer = document.querySelector('#add-customer');
        newCustomer.classList.toggle("visible");
    });

    // Permet de faire une recherche par nom d'un client et affiche sous forme de liste
    gestionSearch.addEventListener('keyup', async function (e) {

        if (e.key == 'Enter') {

            //Reset du résultat de recherche
            if (document.querySelector('.search-result ul')) {
                document.querySelector('.search-result ul').remove();
            }

            // Si le champs est vide, je ne fais aucune requête
            if (gestionSearch.value !== '') {

                // Requête de la liste des clients recherchés
                response = await fetch(`${window.origin}/gestion-clients/api/${encodeURI(gestionSearch.value)}`);
            } else {
                response = await fetch(`${window.origin}/gestion-clients/api/all`);
            }
            json = await response.json();

            // Création de la liste
            let list = document.createElement('ul');
            list.classList.add('collection', 'with-header');
            searchResult.appendChild(list);

            // Création du titre pour le résultat de la recherche
            let titleResult = document.createElement('li');
            titleResult.classList.add('collection-header');

            // S'il y a un client ou plus alors je créé le contenu de la liste avec un lien pour accéder à la fiche
            if (json.length > 0) {

                let client = (json.length > 1) ? 'clients' : 'client';
                titleResult.innerHTML = `Il y a ${json.length} ${client}`;
                list.appendChild(titleResult);

                json.forEach(client => {

                    let listResult = document.createElement('a');
                    listResult.href = `/fiche-client/${client.id}/${client.nom}`;
                    listResult.classList.add('collection-item');
                    let date_naissance = new Date(client.date_naissance);
                    listResult.innerHTML = `${client.nom} ${client.prenom} née le ${date_naissance.toLocaleDateString('fr-FR')}`;
                    list.appendChild(listResult);
                })

                // Sinon j'indique qu'il y a aucun client présent dans la recherche
            } else {
                titleResult.innerHTML = "Il n'y a aucun client avec ce nom";
                list.appendChild(titleResult);
            }
        }
    });

    // Efface les resultats de recherche
    searchClose.addEventListener('click', function () {
        if (document.querySelector('.search-result ul')) {
            document.querySelector('.search-result ul').remove();
        }
    })
})