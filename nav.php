 <?php if(isset($_SESSION['ID']) && $_SESSION['ID'] > 0){
   
?>

    <nav id="y" class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" style="background-color: white"></span>
                <span class="icon-bar" style="background-color: white"></span>
                <span class="icon-bar" style="background-color: white"></span>
            </button>
            <a title= "Les Gardiens de la Galaxie" class="navbar-brand" href="index.php">Les Gardiens de la Galaxie </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="police">
    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">

    <form class="nav navbar-nav navbar-right" method="POST" action="">
     <li><a title="Gardiens de la Galaxie" href="index.php">Accueil</a></li>
                <li><a title="À propos du film" href="film.php">le film</a></li>
                <li><a title="Galerie photo" href="galerie.php">Galerie/Fan Art</a></li>
                <li><a title="Trailer du deuxième film" href="trailer.php">Trailer film 2</a></li>
                <li><a title="Trailer du deuxième film" href="perso.php">Quizz</a></li>
                 <li><a title="News" href="news.php">News</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Compte
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                       <div style="text-align: center;"><?php echo 'Bonjour, ' . $_SESSION['Prenom'] .''; ?>
                       <li role="separator" class="divider"></li>
                       <li><a href="profile.php" class="btn btn-block btn-info">Mon Profil</a></li>
                       <br>
                       <li><a href="deconnexion.php" class="btn btn-block btn-danger">Déconnexion</a></li>
                        </div>   
                    </ul>
                   </li>
   </form>
   </div>
   </div>
   </div>
   </nav>

    <?php
    }
    else{
    ?>
  <nav id="y" class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" style="background-color: white"></span>
                <span class="icon-bar" style="background-color: white"></span>
                <span class="icon-bar" style="background-color: white"></span>
            </button>
            <a title= "Les Gardiens de la Galaxie" class="navbar-brand" href="index.php">Les Gardiens de la Galaxie </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="police">
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">

            <form class="nav navbar-nav navbar-right" method="POST" action="">

                <li><a title="Gardiens de la Galaxie" href="index.php">Accueil</a></li>
                <li><a title="À propos du film" href="film.php">le film</a></li>
                <li><a title="Galerie photo" href="galerie.php">Galerie/Fan Art</a></li>
                <li><a title="les vidéos" href="trailer.php">Trailer film 2</a></li>
                <li><a title="Inscription" href="inscription.php">Inscription</a></li>
                <li><a title="News" href="news.php">News</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Connexion
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                       
                           <input name="Email" type="text" placeholder="Email" class="form-control">
                            <input name="MDP" type="password" placeholder="Mot de passe" class="form-control">
                            <input class="btn btn-block btn-primary" type="submit" name="formconnexion" role="button" value="Envoyer">
                     </ul>
                     </li>

             </form>                         
        </div>
    </div>
    </div>
</nav>

    <?php
    } ?>
 




  