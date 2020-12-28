document.addEventListener('DOMContentLoaded', function () {
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
});