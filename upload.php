
<?php

session_start();

//Envoi BDD

if(isset($_POST['submit'])){
    $target = "uploads/".basename($_FILES['image']['name']);
}

$bdd = new PDO('mysql:host=localhost;dbname=web;charset=utf8', 'root', 'root');

$image = $_FILES['image']['name'];

$sql = "INSERT INTO photo(URL, UserID) VALUES('$image', 1)";
$bdd->exec($sql);



$target_dir = "uploads/";
echo " ";

$target_file = $target_dir.$_SESSION['ID'].".jpg";

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "l'objet est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Ce n'est pas une image.";
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["image"]["size"] > 500000) {
    echo "L'image est trop grande!.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Seuls les JPG, JPEG, PNG & GIF sont autorisés.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
//if ($uploadOk == 0) {
    $result = glob($target_file);

    if($result){
        unlink($target_file);
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "l'image ". basename( $_FILES["image"]["name"]). " a été enregistrée.";
    } else {
        echo "Il y a eu une erreur lors de l'enregistrement.";
    }
header('Location: profile.php');
?>