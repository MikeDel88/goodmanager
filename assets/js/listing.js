document.addEventListener('DOMContentLoaded', function () {
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

})