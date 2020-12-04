document.addEventListener('DOMContentLoaded', function () {

    let tooltips = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltips);

    let modal = document.querySelectorAll('.modal');
    M.Modal.init(modal);

    let datePicker = document.querySelectorAll('.datepicker');
    M.Datepicker.init(datePicker, {
        firstDay: 1,
        format: "dd-mm-yyyy",
        yearRange: [1930, new Date().getFullYear()],
        i18n: {
            months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
            weekdays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            weekdaysAbbrev: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            cancel: 'Fermer',
        }
    });

    let select = document.querySelectorAll('select');
    M.FormSelect.init(select);

    let item = document.querySelectorAll('.list-item span');
    let figure = document.querySelector('aside figure');
    let aside = document.querySelector('aside');
    let icons = document.querySelectorAll('.nav-icon');
    let copyright = document.querySelector('aside footer p');
    let settings = document.querySelector('main header .settings');
    let json;


    // Permet de faire du responsive pour le menu de navigation
    function windowMobile(aside, figure, item, icons) {
        aside.style.width = '100px';
        figure.style.display = 'none';
        item.forEach(libelle => {
            libelle.style.display = "none";
        });
        icons.forEach(icon => {
            icon.style.width = '100%';
            icon.style.textAlign = 'center';
        });
        copyright.style.fontSize = '12px';
    }
    function windowDesktop(aside, figure, item, icons) {
        aside.style.width = '';
        figure.style.display = 'block';
        item.forEach(libelle => {
            libelle.style.display = "inline";
        });
        icons.forEach(icon => {
            icon.style.width = '';
            icon.style.textAlign = '';
        });
        copyright.style.fontSize = '';
    }
    (window.innerWidth < 600) ? windowMobile(aside, figure, item, icons) : windowDesktop(aside, figure, item, icons);
    window.onresize = function () {
        (window.innerWidth < 600) ? windowMobile(aside, figure, item, icons) : windowDesktop(aside, figure, item, icons);
    }

    // Rend la fenêtre des paramètres visible ou non
    settings.addEventListener('click', function () {
        let settingsMenu = document.querySelector('.settings-menu');
        settingsMenu.classList.toggle("visible");
    });

    if (document.querySelector('#page-gestion')) {

        let addCustomer = document.querySelector('#page-gestion .add-customer');
        let gestionSearch = document.querySelector('#gestion-search');
        let searchResult = document.querySelector('.search-result');
        let searchClose = document.querySelector('.search-close');

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
                    let response = await fetch(`${window.origin}/gestion-clients/api/${gestionSearch.value}`);
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
                            listResult.href = `/fiche-client/${client.id}/${client.last_name}`;
                            listResult.classList.add('collection-item');
                            let birthday = new Date(client.birthday);
                            listResult.innerHTML = `${client.last_name} ${client.first_name} née le ${birthday.toLocaleDateString('fr-FR')}`;
                            list.appendChild(listResult);
                        })

                        // Sinon j'indique qu'il y a aucun client présent dans la recherche
                    } else {
                        titleResult.innerHTML = "Il n'y a aucun client avec ce nom";
                        list.appendChild(titleResult);
                    }

                }
            }
        });

        // Efface les resultats de recherche
        searchClose.addEventListener('click', function () {
            if (document.querySelector('.search-result ul')) {
                document.querySelector('.search-result ul').remove();
            }
        })
    }

    if (document.querySelector('#page-listing')) {

        let listingSearch = document.querySelector('#select-search');

        // Si je sélectionne un filtre dans la recherche, alors je soumets la recherche
        listingSearch.addEventListener('change', function () {
            document.querySelector('.form-listing').submit();
        });

        // si un tableau existe
        if (document.querySelector('tbody')) {

            // Tri du tableau dynamique
            const compare = (ids, asc) => (row1, row2) => {
                const tdValue = (row, ids) => row.children[ids].textContent;
                const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
                return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
            };

            const tbody = document.querySelector('tbody');
            const thx = document.querySelectorAll('th');
            const trxb = tbody.querySelectorAll('tr');

            thx.forEach(th => th.addEventListener('click', () => {
                let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
                classe.forEach(tr => tbody.appendChild(tr));
            }));
        }


        // cocher ou décocher un contact client
        let contact = document.querySelectorAll("#page-listing input[type='checkbox']");
        contact.forEach(checkbox => checkbox.addEventListener('click', async function () {
            let clientId = this.getAttribute('data-client-id');
            let method;
            if (this.getAttribute('checked') == 'checked') {
                this.removeAttribute('checked');
                method = 'DELETE';
            } else {
                method = 'POST';
                this.setAttribute('checked', 'checked');
            }
            let response = await fetch(

                `${window.origin}/liste-clients/api/contact`,
                {
                    method: method,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ id: clientId }),
                }
            );
            let msg = await response.json();
            console.log(msg.status);
        }));


        // Récupérer la liste de l'historique des contacts du client
        let ligneClient = document.querySelectorAll('tbody tr .ligne-client');
        ligneClient.forEach(client => client.addEventListener('click', async function () {

            // Reste de la liste
            if (document.querySelector('.modal-content ul')) {
                document.querySelector('.modal-content ul').remove();
            }

            // Je selectionne le bloc modal et je l'ouvre
            let modal = document.querySelector('.modal');
            M.Modal.init(modal);
            let instanceModal = M.Modal.getInstance(modal);
            instanceModal.open();

            // Je récupère l'id du client que je souhaite consulter
            let idClient = client.parentNode.getAttribute('data-id');
            let response = await fetch(`${window.origin}/liste-clients/api/history/${idClient}`);
            listeContacts = await response.json();

            // Je crée ma liste
            let modalContent = document.querySelector('.modal .modal-content');
            let liste = document.createElement('ul');
            modalContent.appendChild(liste);

            // Pour chaque ligne de contact dans le tableau, j'affiche un item de la liste
            listeContacts.forEach(function (contact) {

                let contactDate = new Date(contact.date);
                contactDateFR = contactDate.toLocaleDateString('fr-FR');

                let item = document.createElement('li');
                item.innerHTML = `Le ${contactDateFR}`;

                liste.appendChild(item);

            });

        }));

    }




});

