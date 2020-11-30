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
<body>
  <header>
    <nav class="#0d47a1 blue darken-2">
        <div class="nav-wrapper">
          <a href="/" class="brand-logo"><img src="../assets/images/logo.png" alt="logo goodmanager" class="logo"></a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="/">Accueil</a></li>
            <li><a href="/inscription">S'inscrire</a></li>
            <li><a href="/connexion">Se connecter</a></li>
          </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
          <li>
            <div class="center-align"><img src="../assets/images/logo.png" alt="logo goodmanager" class="logo"></div>
            <div class="divider"></div>
          </li>
          <li><a href="/"><i class="material-icons">home</i>Accueil</a></li>
          <li><a href="/inscription"><i class="material-icons">person_add</i>S'inscrire</a></li>
          <li><a href="/connexion"><i class="material-icons">person</i>Se connecter</a></li>
    </ul>
  </header>
    <?=$output?>
  <footer class=" #0d47a1 blue darken-2 footer-copyright">
      <div class="copyright #f5f5f5 white-text lighten-4 right-align">
        © copyright michael delamarre - <?= date("Y") ?>
      </div>
  </footer>
</body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="<?= $js ?>"></script>
</html>