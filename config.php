<?php

session_start();



if(isset($_SESSION['Email'])){
    
}
else{

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "web";


try

{

$bdd = new PDO('mysql:host=localhost;dbname=web;charset=utf8', 'root', 'root');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
}
catch (Exception $e)
{
    echo "connection failed: " . $e->getMessage();
}


$rempli = 0;


	if(isset($_POST['formconnexion'])) 
	{
		if(isset($_POST['Email']))
			$Email=$_POST['Email'];
		else
			$Email="";

		if(isset($_POST['MDP']))
			$MDP=$_POST['MDP'];
		else
			$MDP="";

		// Vérification des identifiants
		$req = $bdd->prepare('SELECT * FROM utilisateur WHERE Email = :Email AND MDP = :MDP');
		$req->execute(array(
		    'Email' => $Email,
		    'MDP' => $MDP));
		$resultat = $req->fetch();

		if (!$resultat){
		    //echo 'Mauvais identifiant ou mot de passe !';
		    $rempli = 4;
		}
		else{
		    //session_start();
		    $_SESSION['ID'] = $resultat['ID'];
		    $_SESSION['Nom'] = $resultat['Nom'];
		    $_SESSION['Prenom'] = $resultat['Prenom'];
		    $_SESSION['DateNaissance'] = $resultat['DateNaissance'];
		    $_SESSION['Sexe'] = $resultat['Sexe'];
		    $_SESSION['Admin'] = $resultat['Admin'];
		    $_SESSION['Email'] = $resultat['Email'];
		 
		    $rempli = 5;
    		header('Location: profile.php');
    		
		}
	}


	if(isset($_POST['forminscription'])) 
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

		if(!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Email']) AND !empty($_POST['MDP']) AND !empty($_POST['Sexe'])AND !empty($_POST['DateNaissance'])) {

			if(filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$reqEmail = $bdd->prepare("SELECT * FROM utilisateur WHERE Email = ?");
				$reqEmail->execute(array($Email));
				$Emailexist = $reqEmail->rowCount();

				if($Emailexist == 0) {
					$req = $bdd->prepare('INSERT INTO utilisateur (Nom,Prenom,Email,MDP,Sexe,DateNaissance) VALUES(:Nom, :Prenom, :Email, :MDP, :Sexe, :DateNaissance)');
					$req->execute(array(
						'Nom' => $Nom,
						'Prenom' => $Prenom,
						'Email' => $Email,
						'MDP' => $MDP,
						'Sexe' => $Sexe,
						'DateNaissance' => $DateNaissance
						));
					$rempli = 3;
				} 
				else {
					$rempli = 2;
				}
			}
		}
		else{
			$rempli = 1;
		}
	}
	?>

	<?php
		switch ($rempli) {
			case 0:
				break;
			
			case 1:
				echo "<script>alert(\"Veuillez remplir tous les champs\")</script>";
				break;
			
			case 2:
				echo "<script>alert(\"Adresse mail déjà utilisée !\")</script>";
				break;
			
			case 3:
				echo "<script>alert(\"Utilisateur ajouté à la BDD !\")</script>";
				break;
				
			case 4:
				echo "<script>alert(\"Mauvais Email ou Mot de Passe\")</script>";
				break;

			case 5:
				echo "<script>alert(\"Connecté avec succès\")</script>";
				break;

			default:
				echo "<script>alert(\"Autre cas ?\")</script>";
				break;
		}
	
	?>

		</div>
		


<?php
}
?>