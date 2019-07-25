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
    <img src="img/rocket.jpg" alt="les gardiens de la galaxie" class="image1">

</div>


<div class="container">
    <div class="col-md-6">
        <h1>Bienvenue Gardiens!</h1>
        <p>Rejoignez star lord et ses compagnons pour protéger la galaxie!</p>
        <img alt="gif star-lord danse" src="img/dance.gif">
    </div>
    <div class="col-md-6" style="margin-top: 110px">
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="Nom">Nom: &nbsp</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" placeholder="Nom" id="Nom" name="Nom" value="<?php if(isset($Nom)) { echo $Nom; } ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Prenom">Prénom: &nbsp</label>
                    </td>
                    <td>
                        <input class="form-control" type="text" placeholder="Prénom" id="Prenom" name="Prenom" value="<?php if(isset($Prenom)) { echo $Prenom; } ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Email">Email: &nbsp</label>
                    </td>
                    <td>
                        <input class="form-control" type="email" placeholder="Email" id="Email" name="Email" value="<?php if(isset($Email)) { echo $Email; } ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="MDP">Mot de passe: &nbsp</label>
                    </td>
                    <td>
                        <input class="form-control" type="password" placeholder="*******" id="MDP" name="MDP" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Date de naissance: &nbsp</label>
                    </td>
                    <td>
                        <input class="form-control" type="date" placeholder="YYYY-MM-DD" id="DateNaissance" name="DateNaissance" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="Sexe">Sexe: &nbsp</label>
                    </td>
                    <td>
                        <div class="radio">
                            <label><input type="radio" name="Sexe" value="Homme" checked>Homme</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="Sexe" value="Femme">Femme</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />
                        <input class="form-control" type="submit" name="forminscription" value="Valider"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>













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