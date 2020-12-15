document.addEventListener('DOMContentLoaded', function () {

    let tooltips = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltips);

    let modal = document.querySelector('.modal');
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


    function resetModal() {

        if (document.querySelector('.modal-content .last-contact')) {
            document.querySelector('.modal-content .last-contact').remove();
        }
        if (document.querySelector('.modal-content .rendez-vous')) {
            document.querySelector('.modal-content .rendez-vous').remove();
        }
    }

    let item = document.querySelectorAll('.list-item span');
    let figure = document.querySelector('aside figure');
    let aside = document.querySelector('aside');
    let icons = document.querySelectorAll('.nav-icon');
    let copyright = document.querySelector('aside footer p');
    let settings = document.querySelector('main header .settings');
    let json;
    let response;


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
    }

    if (document.querySelector('#page-listing')) {

        let listingSearch = document.querySelector('#select-search');
        let instanceModal = M.Modal.getInstance(modal);

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

            resetModal();

            // Je selectionne le bloc modal et je l'ouvre
            instanceModal.open();

            // Je récupère l'id du client que je souhaite consulter
            let idClient = client.parentNode.getAttribute('data-id');
            let nameClient = client.parentNode.getAttribute('data-name');
            let response = await fetch(`${window.origin}/liste-clients/api/history/${idClient}`);
            listeContacts = await response.json();

            // Je crée ma liste
            let modalContent = document.querySelector('.modal .modal-content');
            let divContact = document.createElement('div');
            divContact.classList.add('last-contact');
            let title = document.createElement('h5');
            title.innerHTML = `Liste des derniers contacts de ${nameClient}`
            let liste = document.createElement('ul');
            modalContent.appendChild(divContact);
            divContact.appendChild(title);
            divContact.appendChild(liste);

            // Pour chaque ligne de contact dans le tableau, j'affiche un item de la liste
            listeContacts.forEach(function (contact) {

                let contactDate = new Date(contact.date);
                contactDateFR = contactDate.toLocaleDateString('fr-FR');

                let item = document.createElement('li');
                item.innerHTML = `Le ${contactDateFR} par ${contact.nom} ${contact.prenom}`;

                liste.appendChild(item);

            });

        }));

        // Clique sur ajouter un rendez-vous
        let ligneEvent = document.querySelectorAll('tbody tr .add-event');
        ligneEvent.forEach(event => event.addEventListener('click', function () {


            // Reset de la liste
            resetModal();
            // ouverture de la modal
            instanceModal.open();

            let nameClient = event.parentNode.parentNode.getAttribute('data-name');
            let idClient = event.parentNode.parentNode.getAttribute('data-id');
            let modalContent = document.querySelector('.modal .modal-content');
            let divContact = document.createElement('div');
            divContact.classList.add('rendez-vous');
            let title = document.createElement('h5');
            title.innerHTML = `Prendrez rendez-vous avec ${nameClient}`
            modalContent.appendChild(divContact)
            divContact.appendChild(title);

            let form = document.createElement('form');
            divContact.appendChild(form);

            let inputDate = document.createElement('input');
            inputDate.setAttribute('type', 'datetime-local');
            inputDate.setAttribute('name', 'date');
            inputDate.classList.add('datepicker');
            inputDate.setAttribute('required', '');
            form.appendChild(inputDate);

            let button = document.createElement('a');
            button.innerHTML = 'Enregistrer';
            button.classList.add('btn', 'teal');
            form.appendChild(button);

            button.addEventListener('click', async function () {
                if (inputDate.value !== '') {

                    let response = await fetch(

                        `${window.origin}/rendez-vous/api/add-rdv`,
                        {
                            method: 'POST',
                            headers: {
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({ id: idClient, dateRDV: inputDate.value }),
                        }
                    );
                    let msg = await response.json();
                    if (msg.status == 'add_rdv') {
                        instanceModal.close();
                    }
                }
            })

        }))
    }

    if (document.querySelector('#page-rdv')) {

        // Récupère l'ensemble des rendez-vous d'un utilisateur
        async function getAllEvents() {

            let response = await fetch(`${window.origin}/rendez-vous/api/liste`);
            json = await response.json();
            json.forEach(event => {
                let calendarEvent = {
                    id: event.rdv_id,
                    title: `${event.nom}  ${event.prenom}`,
                    start: event.date
                }
                calendar.addEvent(calendarEvent);
            })
        }

        // Génère un calendrier fullcalendar
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: { center: 'dayGridMonth,dayGridWeek,dayGridDay' },
            initialView: 'dayGridWeek',
            height: 650,
            weekends: true,
            weekNumbers: true,
            weekText: 'S',
            buttonText: {
                today: 'Aujourd\'hui',
                day: 'Jour',
                week: 'Semaine',
                month: 'Mois'
            },
            firstDay: 1,
            showNonCurrentDates: false,
            fixedWeekCount: false,
            // Lors d'un clique sur une date, je peux ajouter un rendez-vous avec un client
            dateClick: function (info) {

                resetModal();

                let instanceModal = M.Modal.getInstance(modal);
                instanceModal.open();

                let modalContent = document.querySelector('.modal-content');

                let divRDV = document.createElement('div');
                divRDV.classList.add('rendez-vous');


                let dateRDV = new Date(info.dateStr);
                let dateJour = dateRDV.toLocaleDateString('fr-FR');

                let title = document.createElement('h6');
                title.innerHTML = `Prendre un rendez-vous pour le ${dateJour}`;

                let form = document.createElement('form');

                let inputSearch = document.createElement('input');
                inputSearch.setAttribute('type', 'search');
                inputSearch.classList.add('clientSearch');
                inputSearch.placeholder = 'rechercher un client par nom';


                modalContent.appendChild(divRDV);
                divRDV.appendChild(title);
                divRDV.appendChild(form);
                form.appendChild(inputSearch);

                inputSearch.addEventListener('change', async function () {

                    if (inputSearch.value !== '') {
                        let response = await fetch(`${window.origin}/gestion-clients/api/${inputSearch.value}`);
                        json = await response.json();
                        if (json.length !== 0) {

                            if (document.querySelector('.modal-content .rendez-vous form select')) {
                                document.querySelector('.modal-content .rendez-vous form select').remove()
                            }
                            if (document.querySelector('.modal-content .rendez-vous form .time')) {
                                document.querySelector('.modal-content .rendez-vous form .time').remove()
                            }
                            if (document.querySelector('.modal-content .rendez-vous form a')) {
                                document.querySelector('.modal-content .rendez-vous form a').remove()
                            }


                            let inputSelect = document.createElement('select');
                            inputSelect.setAttribute('name', 'client_id');
                            inputSelect.style.display = 'block';

                            form.appendChild(inputSelect);

                            json.forEach(client => {
                                console.log(client)
                                let option = document.createElement('option');
                                option.value = client.id;
                                option.innerHTML = `${client.nom} ${client.prenom} née le ${new Date(client.date_naissance).toLocaleDateString('fr-FR')}`
                                inputSelect.appendChild(option);
                            })

                            let inputTime = document.createElement('input');
                            inputTime.setAttribute('type', 'time');
                            inputTime.classList.add('time');

                            form.appendChild(inputTime);

                            let button = document.createElement('a');
                            button.innerHTML = 'Enregistrer';
                            button.classList.add('btn', 'teal')
                            form.appendChild(button);

                            button.addEventListener('click', async function () {

                                let response = await fetch(

                                    `${window.origin}/rendez-vous/api/add-rdv`,
                                    {
                                        method: 'POST',
                                        headers: {
                                            "Accept": "application/json",
                                            "Content-Type": "application/json",
                                        },
                                        body: JSON.stringify({ id: inputSelect.value, dateRDV: `${info.dateStr} ${inputTime.value}` }),
                                    }
                                );
                                let msg = await response.json();
                                if (msg.status == 'add_rdv') {
                                    instanceModal.close();
                                    let result = calendar.getEvents();
                                    result.forEach(event => {
                                        event.remove();
                                    })
                                    getAllEvents();
                                }

                            })

                        }
                    }
                })

            },
            eventClick: function (info) {

                resetModal();

                let instanceModal = M.Modal.getInstance(modal);
                instanceModal.open();

                let modalContent = document.querySelector('.modal-content');

                let divRDV = document.createElement('div');
                divRDV.classList.add('rendez-vous');

                let title = document.createElement('h6');
                title.innerHTML = `Rendez-vous avec ${info.event.title}`;

                let form = document.createElement('form');


                let inputDate = document.createElement('input');
                inputDate.setAttribute('type', 'datetime-local');

                modalContent.appendChild(divRDV);
                divRDV.appendChild(title);
                divRDV.appendChild(form);
                form.appendChild(inputDate);

                let buttonModifier = document.createElement('a');
                buttonModifier.innerHTML = 'Modifier';
                buttonModifier.classList.add('btn', 'teal', 'modifier')
                buttonModifier.style.marginRight = '35px'
                form.appendChild(buttonModifier);

                let buttonSupprimer = document.createElement('a');
                buttonSupprimer.innerHTML = 'Supprimer';
                buttonSupprimer.classList.add('btn', 'red', 'supprimer')
                form.appendChild(buttonSupprimer);

                buttonSupprimer.addEventListener('click', async function () {
                    let response = await fetch(

                        `${window.origin}/rendez-vous/api/delete-rdv`,
                        {
                            method: 'DELETE',
                            headers: {
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({ id: info.event.id }),
                        }
                    );
                    let msg = await response.json();
                    if (msg.status == 'delete_rdv') {
                        instanceModal.close();
                        let result = calendar.getEvents();
                        result.forEach(event => {
                            event.remove();
                        })
                        getAllEvents();
                    }
                })

                buttonModifier.addEventListener('click', async function () {
                    let response = await fetch(

                        `${window.origin}/rendez-vous/api/modification-rdv`,
                        {
                            method: 'POST',
                            headers: {
                                "Accept": "application/json",
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({ id: info.event.id, dateRDV: inputDate.value }),
                        }
                    );
                    let msg = await response.json();
                    if (msg.status == 'modification_ok') {
                        instanceModal.close();
                        let result = calendar.getEvents();
                        result.forEach(event => {
                            event.remove();
                        })
                        getAllEvents();
                    }
                })

            }

        });
        calendar.setOption('locale', 'fr');
        calendar.render();
        getAllEvents();
    }

    if (document.querySelector('#page-comptes')) {

        // Si je clique sur le bouton close pour supprimer un collaborateur, je soumet le formulaire post
        let closes = document.querySelectorAll('.close')
        closes.forEach(close => close.addEventListener('click', function () {
            console.log("CLICK LIEN OK")
            let form = this.previousElementSibling
            document.querySelector('#page-comptes .modal-close').addEventListener('click', function () {
                if (!isNaN(form.firstChild.nextElementSibling.value)) {
                    console.log("VALUE JS OK")
                    form.submit();
                } else {
                    console.log("PAS OK")
                }
            })
        }))
    }


});

