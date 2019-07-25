<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Miguel Molano projet fin d'année Restart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styletext.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <link rel="icon" href="icons/gardiens.png">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>



<?php include ('config.php'); ?>

<?php include ('nav.php'); ?>



<div class="image">
    <img src="img/Star-Lord.png" alt="les gardiens de la galaxie" class="image1">

</div>




<?php



if(!isset($_SESSION['Email'])){
    header('Location: index.php');
}

else
{

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "web";

    try {
        $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Bienvenue, ";

    }
    catch(PDOException $e) {
        echo "connection failed: " . $e->getMessage();
    }


    if(isset($_GET['id']))
    {
        $utilisateur= $bdd->query("SELECT Nom, Prenom, DateNaissance, MDP, Sexe, Email, FROM utilisateur WHERE ID =".$_GET['id']);


        $donnees = $utilisateur->fetch();
        echo $donnees['Prenom'] . '<br />';

        $donnees['ID'] = $_GET['id'];
        $utilisateur->closeCursor();

    }



    else 
    {
        $donnees = $_SESSION;
        echo $donnees['Prenom'] . '<br />';



    }




    if(isset($_POST['Save']))
    {
    // On commence par récupérer les champs 

       if(isset($_POST['Email']))
        $Email=$_POST['Email'];
    else{
        $Email="";
        echo "em";
    }

   if(isset($_POST['MDP']))
        $MDP=$_POST['MDP'];
    else{
        $MDP="";
        echo "MDP";
    }



    if(isset($_POST['DateNaissance']))
        $DateNaissance=$_POST['DateNaissance'];
    else{
        $DateNaissance="";
        echo "nais";
    }









    if(!empty($_POST['Email']) AND !empty($_POST['DateNaissance']) AND !empty($_POST['MDP'])) {
        if(filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $reqEmail = $bdd->prepare("SELECT * FROM utilisateur WHERE Email = ?");
            $reqEmail->execute(array($Email));
            $Emailexist = $reqEmail->rowCount();

            if($Emailexist == 0||$Email==$_SESSION['Email']) {
                $req = $bdd->prepare("UPDATE utilisateur SET  Email= :Email, DateNaissance=:DateNaissance, MDP= :MDP WHERE ID = " . $_SESSION['ID']);
                $req->execute(array(

                    'Email' => $Email,
                    'MDP' => $MDP,
                    'DateNaissance' => $DateNaissance,
                    

                    ));
                $_SESSION['Email'] = $Email; 
                $_SESSION['MDP'] = $MDP;   
                $_SESSION['DateNaissance'] = $DateNaissance;
                 
               

 
echo "Vos données ont été mis à jour :) veuillez recharger la page ";
}
else {
    echo "Adresse deja utilisee";
}
}
else {
    echo "Mauvais Email";
}

}
else echo "REMPLIR tous les champs svp";
}


?>


 <div class="container">
  <div class="row">
      <div class="col-md-3 salut">
          <div class="well">
             <h2><center>Profil</center></h2>

             <!--<img src="uploads/<?php echo $_SESSION['ID']; ?>/<?php echo $_SESSION['Path']; ?>" class="profile img-responsive img-thumbnail">-->

            <?php

             $result = glob("uploads/".$donnees['ID'].".jpg");

             if($result){
                $path = "uploads/".$donnees['ID'].".jpg";
            }
            else
                $path="img/default.jpg";
            ?>
            <img src="<?php echo $path ?>" alt="" class="img-thumbnail" id="imgProfil" style="width: 210px; height: 210px">
             <?php if(!isset($_GET['id']))
                        {
                            ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Choisissez une image:
                <input onchange="readURL(this);" type="file" name="image" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
              <?php } ?>
            <center><h4><?php echo $donnees['Prenom'] . " " . $donnees['Nom']; ?></h4></center>
                        <!-- <br>
                        <a href="index.php"><button type="submit" class="btn btn-success">Déconnexion</button></a> -->
                        <?php if(!isset($_GET['id']))
                        {
                            ?>

                            <div>
                              <center><a href="admin.php" style="color:blue;"><input <?php echo $donnees['Admin'] == 0 ? "hidden" : "";?> type="button" value="Privilèges Admin" id="boutonAdmin"></a></center>
                          </div>
                          <?php } ?>
                      </div>
                  </div>

                  <div class="col-md-9 salut">
                    <div class="row">
                        <div class="col-md-6">

                            <h3>Coordonnées</h3>
                            <br><b>Adresse mail:</b>  <?php echo $donnees['Email']; ?>
                            
                            <br>
                            <br>

                            <h3>Informations personnelles</h3>
                            <br><b>Date de naissance:</b>  <?php echo isset($donnees['DateNaissance']) ? $donnees['DateNaissance'] : "Non renseigné"; ?>
                            <br><b>Sexe:</b>  <?php echo isset($donnees['Sexe']) ? $donnees['Sexe'] : "Non renseigné"; ?>
                           

                        </div>
                        <div class="col-md-6">
    
                            <a href="deconnexion.php" class="btn btn-xs btn-danger">Déconnexion</a>

                            <br>
                            <br>

                        </div>
                    </div>
                    <div class="row">

                        <br>
                        <br>
                        <b><i>Inscription sur le site: Oui </i></b>

                        <!-- Large modal -->
                        <br>
                        <br>

                        <?php if(!isset($_GET['id']))
                        {
                            ?>
                            <button id="modif" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> Modifier les informations</button>

                            <?php } ?>
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h2 class="modal-title" id="gridSystemModalLabel">Changer mes informations</h2>
                                        </div>
                                        <form method="POST" action="">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <h3>Coordonnées</h3>
                                                        <br>Adresse mail:  <input value="<?php echo $donnees['Email'] ?>" type="text" class="form-control" id="inputMail" placeholder="Ex: star-lord@gmail.com" name="Email">
                                                        

                                                        <h3>Informations personnelles</h3>
                                                        <br>Date de naissance:  <input value="<?php echo $donnees['DateNaissance'] ?>" type="date" class="form-control" placeholder="1990-04-25" name="DateNaissance">
                                                        <br>
                                                        <br>Nouveau Mot de passe:  <input value="<?php echo $donnees['MDP'] ?>" type="password" class="form-control"  placeholder="Mot de passe" name="MDP">
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" name="Save">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </body>
        </html>

        <?php
    }
    ?>


       

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});</script>
 <script type="text/javascript" src="js/cropper.js"></script>

</body>
</html>