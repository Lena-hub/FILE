<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){ 
   
    $uploadDir = '\..\FILE\form.php';
  
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    
    $authorizedExtensions = ['jpg','png','gif','webp'];
   
    $maxFileSize = 1000000;

    
    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = "Veuillez sélectionner une image de type jpg, png, gif ou webp !";
    }

    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if(!isset($errors)){
      $newFile = uniqid('avatar', true). '.' . $extension;
      move_uploaded_file($_FILES['avatar']['tmp_name'], $newFile);
  }
  echo "<img src=".$uploadFile."/>";
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>LAISSE PAS TRAINER TON FILE</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>

<form method="post" enctype="multipart/form-data">
   <br><label for="imageUpload">Importe ta photo</label>    
    <input type="file" name="avatar" id="imageUpload" /><br><br>
    <button name="send">Importer</button>
</form>


</body>
</html>
