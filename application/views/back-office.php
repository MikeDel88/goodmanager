<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?= $css ?>">
  <title><?= $title ?></title>
</head>
<!-- Voir le clear du cache pour le css -->
<body>
    <aside>
        <figure>
            <img src="<?= base_url() . "assets/images/logo.png"?>" alt="logo goodmanager">
        </figure>
        <div class="nav-back-office">
            <ul class="list-nav">
                <li class="list-item"><a href="#"><i class="material-icons nav-icon">home</i><span class="nav-text">Dashboard</span></a></li>
                <li class="list-item"><a href="#"><i class="material-icons nav-icon">person</i><span class="nav-text">Gestion des comptes</span></a></li>
                <li class="list-item"><a href="/gestion-clients"><i class="material-icons nav-icon">people</i><span class="nav-text">Gestion clients</span></a></li>
                <li class="list-item"><a href="/liste-clients"><i class="material-icons nav-icon">list</i><span class="nav-text">Liste clients</span></a></li>
                <li class="list-item"><a href="#"><i class="material-icons nav-icon">event_available</i><span class="nav-text">Rendez-vous</span></a></li>
                <li class="list-item"><a href="#"><i class="material-icons nav-icon">map</i><span class="nav-text">Géolocalisation</span></a></li>
            </ul>
        </div>
        <footer>
            <p>&copy; copyright - michael delamarre <?= date("Y") ?></p>
        </footer>
    </aside>
    <main>
        <header class="valign-wrapper">
            <h3><?= $page ?></h3>
            <div class="icons valign-wrapper">
                <a href="#" class="settings">
                    <i class="material-icons nav-icon" title="paramètre">settings</i>
                </a>
                <ul class="settings-menu invisible">
                    <li><a href="/espace-personnel">Mon profil</a></li>
                    <li><a href="/deconnexion">Déconnexion</a></li>
                </ul>
            </div>
        </header>
        
            <?=$output?>

    </main>
</body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="<?= $js ?>"></script>
</html>