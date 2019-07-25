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


	<?php include ('config.php') ?>
   <?php include ('nav.php') ?>


<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "web";


try

{

$bdd = new PDO('mysql:host=localhost;dbname=web;charset=utf8', 'root', 'root');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	    
}
catch (PDOException $e)
{
    echo "connection failed: " . $e->getMessage();
}



$req = $bdd ->prepare('SELECT * FROM publication ORDER by ID DESC');
$req->execute();


if (!empty($_POST)){

  $errors = array();

  if(empty(trim($_POST['news_title']))){ 
    $errors['title'] = "Vous devez mettre un titre !";
  
  }

  if(empty(trim($_POST['news_content']))){
      $errors['content'] = "Vous devez mettre un contenu !";
    
     }
   
   if(empty($errors)){
      $req = $bdd->prepare("INSERT INTO publication SET news_title = ?,news_content = ?, news_style = ?, news_date = NOW();");
      $req->execute([$_POST['news_title'], $_POST['news_content'], $_POST['news_style']]);
      header('Location: news.php');
   }
}


?>



   <div>
       <img src="img/gardiens.jpg" alt="image les gardiens de la galaxie" class="image1">

   </div>

    <div class="container">

<div class="row">

 <ul class="nav nav-tabs nav-justified" role="tablist">
          <li role="presentation" style="background-color: grey" class="active"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">Page de News</a></li>
          <li role="presentation" style="background-color: grey"><a href="#ajout" aria-controls="ajout" role="tab" data-toggle="tab">Ajouter une news</a></li>
        </ul>
        



  <div class="tab-content">
          <br>

          <div role="tabpanel" class="tab-pane active" id="news">
            <form method="POST" action="">
              <table>
               <tr>
             
          <?php while($res = $req->fetch(PDO::FETCH_OBJ)): ?>
          	
          	</tr>
<tr>

       <div class="panel panel-<?= $res->news_style; ?>">
       		<div class="panel-heading"><?= $res->news_title; ?><div class="text-right"><a href="edit.php?id=<?= $res->ID; ?>">Edition</a> /<a href="">Supprimer</a></div></div>
       		<div class="panel-body">
       			<?= $res->news_content; ?>
       		</div>
       		<div class="panel-footer">
       			<?= $res->news_date; ?>
       		</div>
    </div>

<?php endwhile; ?>


</tr>
</table>
</form>
</div>



<div role="tabpanel" class="tab-pane" id="ajout">
  	<form method="POST" action="" class="well">

  		<div class="form-group">
  			<label for="news_title">Titre de la news: </label>
  			<input type="text" name="news_title" class="form-control" placeholder="Le titre de votre news" required>
  		</div>
      
   
  		<div class="form-group">
  			<label for="news_content">Contenu de la news: </label>
  			<textarea name="news_content" rows="10" class="form-control" placeholder="Contenu de la news"></textarea>
  		</div>

      <div class="form-group">
        <label for="news_style">Style de la news :</label>
        <select class="form-control" name="news_style">
          <option value="success">Success (Vert)</option>
          <option value="info">Info (Bleu clair)</option>
          <option value="primary">Primary (Bleu foncé)</option>
          <option value="warning">Warning (Orange)</option>
          <option value="danger">Danger (Rouge)</option>

        </select>
      
</div>
   
   <button type="submit" class="btn btn-primary">Créer la news</button>

</form>
























<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script type="text/javascript" src="js/datatables.min.js"></script>



    <script type="text/javascript">$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});</script>


  </body>
</html>
