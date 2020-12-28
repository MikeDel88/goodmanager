document.addEventListener('DOMContentLoaded', function () {

    let tooltips = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltips);

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

});

