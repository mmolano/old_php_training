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
        
    }
    catch(PDOException $e) {
        echo "connection failed: " . $e->getMessage();
    }

    if(isset($_POST['importer'])){

        $image = $_FILES['image']['tmp_name'];
        $URL = $_FILES['image']['name'];
        $UserID = $_SESSION['ID'];

        $req = $bdd->prepare('INSERT INTO photo (URL, UserID) VALUES(:URL, :UserID)');
        
        $req->execute(array(
            'URL' => $URL,
            'UserID' => $UserID
        ));

        $reponse = $bdd->query('SELECT * FROM photo ORDER BY ID DESC');

        $PhotoID = $reponse->fetch()['ID'];//strval($reponse);
        $reponse->closeCursor();

        if(move_uploaded_file($image, "galerie/".$PhotoID.".jpg"))
            echo 'fichier ok';
        else
            echo 'téléchargement impossible';

        header('Location: galerie.php');
    }

    if(isset($_POST['supprimer'])) 
    {
        if(isset($_POST['PhotoGalerieID'])){
            $PhotoID = $_POST['PhotoGalerieID'];
            $sql = "DELETE FROM photo WHERE ID = " . $PhotoID;
            $reponse = $bdd->query($sql);
            $path = "galerie/".$PhotoID.".jpg";
            unlink($path);
        }
    }

?>



<div class="image">
    <img src="img/gardiens2.png" alt="image les gardiens de la galaxie 2" class="image1">

</div>






        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1>Galerie Photos</h1>
                <p>Ici, vous pouvez voir vos photos.</p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
               
              
                <div class="col-md-9">
                    <div id="photo-div">
                        <h3>Photos de l'album</h3>
                        <form method="post" action="" enctype="multipart/form-data" id="float2">
                            <input type="file" class="btn btn-success" name="image">
                            <input type="submit" class="btn btn-success" value="Importer" name="importer" style="display: block">
                        </form>
                        <br>
                        <br>
                        <ul>
                            <?php
                            if($dossier = opendir('galerie')){
                                $compteur = 0;
                                while(false !== ($fichier = readdir($dossier))){
                                    $compteur++;

                                    if($compteur >= 3){
                                        $PhotoID = pathinfo($fichier, PATHINFO_FILENAME);
                                        $reponse = $bdd->query('SELECT * FROM photo WHERE ID = '.$PhotoID);
                                        $PhotoUserID = $reponse->fetch()['UserID'];
                                        $reponse->closeCursor();

                                        if($PhotoUserID == $_SESSION['ID']){
                                            echo '<li style="float: left; background-color: #fff;"><div>';
                                            echo '<div class="scaledImageContainer">';
                                            echo '<img class="resize" src="galerie/'.$fichier.'" alt="photo">';
                                            echo '</div>';
                                            echo '<form method="post" action="" style="text-align: center;">
                                            <input type="hidden" class="btn btn-xs btn-danger" name="PhotoGalerieID" value="'.$PhotoID.'">
                                            <input class="btn btn-xs btn-danger" type="submit" value="supprimer" name="supprimer"/></form>';
                                            echo '</div></li>';
                                        }
                                    }
                                }
                                closedir($dossier);
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
  </div>
     
        <!-- Main jumbotron for a primary marketing message or call to action -->
      



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

</body>
</html>

<?php
}
?>

















