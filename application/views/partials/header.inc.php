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

<script>
    document.addEventListener('DOMContentLoaded', function() {
      let elems = document.querySelectorAll('.sidenav');
      let instances = M.Sidenav.init(elems);
    });
</script>
<style>
  .logo{
    width:100px;
    height:auto;
    margin-top:3px;
  }
</style>
