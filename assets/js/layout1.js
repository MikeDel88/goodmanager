document.addEventListener('DOMContentLoaded', function () {

    // Chargement du composant modal du framework js
    let modal = document.querySelectorAll('.modal');
    M.Modal.init(modal);

    let sidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sidenav);


    // Récupère les id des formulaires mdp
    let mdp_repeat = document.querySelector("#mdp_repeat");
    let mdp = document.querySelector("#mdp");
    let helper;


    if (mdp_repeat !== null) {
        mdp_repeat.addEventListener('change', function () {

            helper = document.querySelector("#helper_mdp_repeat");

            if (mdp.value !== mdp_repeat.value) {
                helper.innerHTML = "Les mots de passe ne correspondent pas";
                helper.style.color = 'red';
            } else {
                helper.innerHTML = "";
            }

        })
    }
    if (mdp !== null) {
        mdp.addEventListener('keypress', function () {

            helper = document.querySelector("#helper_mdp");

            if (mdp.value.length >= 8 && mdp.value.length <= 16) {
                helper.innerHTML = "Mot de passe correct";
                helper.style.color = 'green';
            } else {
                helper.innerHTML = "Mot de passe incorrect";
                helper.style.color = 'red';
            }
        })
    }


});