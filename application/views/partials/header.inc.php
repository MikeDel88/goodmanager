<header>
<nav class="#0d47a1 blue darken-2">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">GoodManager</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/">Accueil</a></li>
        <li><a href="/inscription">S'inscrire</a></li>
        <li><a href="/connexion">Se connecter</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="mobile-demo">
        <li><a href="/">Accueil</a></li>
        <li><a href="/inscription">S'inscrire</a></li>
        <li><a href="/connexion">Se connecter</a></li>
  </ul>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      let elems = document.querySelectorAll('.sidenav');
      let instances = M.Sidenav.init(elems);
    });
</script>
