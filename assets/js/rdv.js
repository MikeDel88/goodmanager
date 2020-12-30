document.addEventListener('DOMContentLoaded', function () {
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

    let modal = document.querySelector('.modal');
    M.Modal.init(modal);
    function resetModal() {

        if (document.querySelector('.modal-content .last-contact')) {
            document.querySelector('.modal-content .last-contact').remove();
        }
        if (document.querySelector('.modal-content .rendez-vous')) {
            document.querySelector('.modal-content .rendez-vous').remove();
        }
    }
    let json;

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

            async function searchClient() {

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
                            console.log("OKKKKKKK");
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
            }
            inputSearch.addEventListener('change', searchClient);

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
});