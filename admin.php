<?php

session_start();

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





  if(isset($_POST['removePerson'])) {
    $req = $bdd->prepare('DELETE FROM utilisateur WHERE ID = :ID');
    $req->execute(array(
        'ID' => $_POST['person']
    ));
    
  }


  if(isset($_POST['formadmin'])) 
  {
        // On commence par récupérer les champs 
    if(isset($_POST['Nom']))
      $Nom=$_POST['Nom'];
    else
      $Nom="";

    if(isset($_POST['Prenom']))
      $Prenom=$_POST['Prenom'];
    else
      $Prenom="";

    if(isset($_POST['Email']))
      $Email=$_POST['Email'];
    else
      $Email="";

    if(isset($_POST['MDP']))
      $MDP=$_POST['MDP'];
    else
      $MDP="";

    if(isset($_POST['Sexe']))
      $Sexe=$_POST['Sexe'];
    else
      $Sexe="";

    if(isset($_POST['DateNaissance']))
      $DateNaissance=$_POST['DateNaissance'];
    else
      $DateNaissance="";

   if(isset($_POST['Admin']))
      $Admin=$_POST['Admin'];
    else
      $Admin="";


    if(!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Email']) AND !empty($_POST['MDP']) AND !empty($_POST['Sexe'])AND !empty($_POST['DateNaissance']) AND !empty($_POST['Admin'])) {

      if(filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $reqEmail = $bdd->prepare("SELECT * FROM utilisateur WHERE Email = ?");
        $reqEmail->execute(array($Email));
        $Emailexist = $reqEmail->rowCount();

        if($Emailexist == 0) {
          $req = $bdd->prepare('INSERT INTO utilisateur (Nom,Prenom,Email,MDP,Sexe,DateNaissance, Admin) VALUES(:Nom, :Prenom, :Email, :MDP, :Sexe, :DateNaissance, :Admin)');
          $req->execute(array(
            'Nom' => $Nom,
            'Prenom' => $Prenom,
            'Email' => $Email,
            'MDP' => $MDP,
            'Sexe' => $Sexe,
            'DateNaissance' => $DateNaissance,
            'Admin' => $Admin
            ));
            echo "<script>alert(\"Utilisateur ajouté à la BDD !\")</script>";
        } 
        else {
          echo "<script>alert(\"Adresse mail déjà utilisée !\")</script>";
        }
      }
     echo "";
    }
    else{
      echo "<script>alert(\"Veuillez remplir tous les champs\")</script>";
    }
  }

  if($_SESSION['Admin'] == 0){
    header('Location: profile.php');}
}


    ?>





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

    <?php include ('nav.php'); ?>



     <!-- Main jumbotron for a primary marketing message or call to action -->
     <div class="jumbotron" style="background-color: #808080">
      <div class="container">
        <h1>Menu d'administration</h1>
        <p>Ici, vous pouvez ajouter et supprimer des utilisateurs.</p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
          <li role="presentation" style="background-color: grey" class="active"><a href="#ajout" aria-controls="ajout" role="tab" data-toggle="tab">Ajouter un utilisateur</a></li>
          <li role="presentation" style="background-color: grey"><a href="#suppression" aria-controls="suppression" role="tab" data-toggle="tab">Supprimer des utilisateurs</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <br>

          <div role="tabpanel" class="tab-pane active" id="ajout">
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
         <label><input type="radio" name="Sexe" value="H" checked="">Homme</label>
       </div>
       <div class="radio">
         <label><input type="radio" name="Sexe" value="F">Femme</label>
       </div>
     </td>
   </tr>
     <tr>
      <td align="right">
       <label for="Admin">Admin: &nbsp</label>
     </td>
     <td>
       <div class="radio">
         <label><input type="radio" name="Admin" value="null" checked="">Non</label>
       </div>
       <div class="radio">
         <label><input type="radio" name="Admin" value="1">Oui</label>
       </div>
     </td>
   </tr>
   <tr>
     <td></td>
     <td align="center">
      <br />
      <input class="form-control" type="submit" name="formadmin" value="Valider"/>
    </td>
  </tr>
</table>
</form>

</div>


<div role="tabpanel" class="tab-pane" id="suppression">
  <table id="table1" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="table1_info" style="width: 100%;" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" style="width: 113px;" aria-label="Name: activate to sort column ascending">
          Id
        </th>
        <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" style="width: 113px;" aria-label="Name: activate to sort column ascending">
          Prénom
        </th>
        <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" style="width: 113px;" aria-label="Name: activate to sort column ascending">
          Nom
        </th>
        <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" style="width: 113px;" aria-label="Name: activate to sort column ascending">
          Email
        </th>
        <th>
          Admin (0=Non, 1=Oui)
        </th>
        <th>
          Photo
        </th>
        <th>
          Supprimer
        </th>
      </tr>
    </thead>
    <tbody>
<?php
    $sql = "SELECT * FROM utilisateur WHERE utilisateur.ID <> ". $_SESSION['ID'];
    $reponse = $bdd->query($sql);

    while ($donnees = $reponse->fetch()) {
        if($donnees['ID'] != $_SESSION['ID']){
    ?>
                        <tr>
                            <td><?php echo $donnees['ID']; ?></td>
                            <td><?php echo $donnees['Prenom']; ?></td>
                            <td><?php echo $donnees['Nom']; ?></td>
                            <td><?php echo $donnees['Email']; ?></td>
                            <td><?php echo $donnees['Admin']; ?></td>
                           
                            <?php
                            $result = glob("uploads/".$donnees['ID']."/profil.*");

                            if($result){
                                $imageFileType = pathinfo("uploads/".$donnees['ID']."/profil", PATHINFO_EXTENSION);
                                $path = "uploads/".$donnees['ID']."/profil.$imageFileType";
                            }
                            else
                                $path="img/default.jpg";
                            ?>
                            

                            <td><img alt="<?php echo $donnees['Prenom'] . " " . $donnees['Nom']; ?>" src="<?php echo $path?>" class="profile-pic"></td>
                            <td>
                                 <form method="POST" action="">
                                    <input type="hidden" name="person" value="<?php echo $donnees['ID']; ?>">
                                    <button type="submit" name="removePerson" value="remove" onclick="if(!confirm('Voulez-vous Supprimer')) return false;"><img src="img/del.png"/ style="height: 30px;"></button>
                                </form> 
                               
                            </td>
                        </tr>
<?php
    }
}
 ?>
    </tbody>
  </table>
</div>

</div>

</div>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/myfile.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>

</body>
</html>

