<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#"><img src="favicon.ico" height="30" width="30"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profil</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="https://getbootstrap.com/docs/4.0/examples/starter-template/#">Disabled</a>
      </li> -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Paramètres</a>
          <a class="dropdown-item" href="#">Déconnexion</a>
        </div>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0" action="logoff.php" method="POST">
      <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
      <span class="navbar-text" style="padding-right: 10px;">
        Vous êtes identifié comme <a href="#" class="badge badge-light"><?php echo $current_login; ?></a>
      </span>
      <button class="btn btn-primary my-2 my-sm-0" name="logoff_button" type="submit">Déconnexion</button>
    </form>
  </div>
</nav>