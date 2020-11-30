document.addEventListener('DOMContentLoaded', function () {

    // Chargement du composant modal du framework js
    let modal = document.querySelectorAll('.modal');
    M.Modal.init(modal);

    let sidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sidenav);


    // Récupère les id des formulaires password
    let password_repeat = document.querySelector("#password_repeat");
    let password = document.querySelector("#password");
    let helper;


    if (password_repeat !== null) {
        password_repeat.addEventListener('change', function () {

            helper = document.querySelector("#helper_password_repeat");

            if (password.value !== password_repeat.value) {
                helper.innerHTML = "Les mots de passe ne correspondent pas";
                helper.style.color = 'red';
            } else {
                helper.innerHTML = "";
            }

        })
    }
    if (password !== null) {
        password.addEventListener('keypress', function () {

            helper = document.querySelector("#helper_password");

            if (password.value.length >= 8 && password.value.length <= 16) {
                helper.innerHTML = "Mot de passe correct";
                helper.style.color = 'green';
            } else {
                helper.innerHTML = "Mot de passe incorrect";
                helper.style.color = 'red';
            }
        })
    }


});