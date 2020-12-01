document.addEventListener('DOMContentLoaded', function () {

    let tooltips = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltips);

    let modal = document.querySelectorAll('.modal');
    M.Modal.init(modal);

    let item = document.querySelectorAll('.list-item span');
    let figure = document.querySelector('aside figure');
    let aside = document.querySelector('aside');
    let icons = document.querySelectorAll('.nav-icon');
    let copyright = document.querySelector('aside footer p');
    let settings = document.querySelector('main header .settings');

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

    settings.addEventListener('click', function () {
        let settingsMenu = document.querySelector('.settings-menu');
        settingsMenu.classList.toggle("visible");
    })
});
