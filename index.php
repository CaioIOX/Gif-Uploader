<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css" />
    <title>Acesse Launcher - Caio</title>
</head>
<body>
    <h1>Acesse Launcher</h1>
    <?php
  session_start();
  $loggedUser = null;
  if(isset($_SESSION["user"])) {
  $loggedUser = $_SESSION["user"];
  }

  function handleFile() {
    $target_dir = "assets/uploads/";
    $fileName = basename($_FILES["filetag"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
    $target_file = $target_dir . md5(date('l jS \of F Y h:i:s A').$fileName).".".$imageFileType;
    // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["filetag"]["tmp_name"]);
      if($check !== false) {
    //    echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
    //    echo "File is not an image.";
        $uploadOk = 0;
      }
      // Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "gif" ) {
  echo "Sorry, only GIF files are allowed.".$imageFileType;
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["filetag"]["tmp_name"], $target_file)) {
    $GLOBALS["newGif"] = $target_file;
    $_SESSION["currentGif"] = $target_file;
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
  }

  if(is_null($loggedUser) && isset($_POST["loginForm"])) {
    $name = $_POST["uname"];
    $pass = $_POST["psw"];
    if($name == "admin" && $pass == "admin") {
      $loggedUser = ["name"=>$name];
      $_SESSION["user"]=$loggedUser;
    }
  }

  if(isset($_POST["fileForm"])) {
    handleFile();
  }
  $currentGif = null;
  if(isset($_SESSION["currentGif"])) {
    $currentGif = $_SESSION["currentGif"];
  }

?>

   <?php if(is_null($loggedUser)) {?>   
    <form id="enter" method="post">
        
        <div class="container">
          <label for="uname"><b>Usuário</b></label>
            <br>
          <input type="text" placeholder="Digite seu login" name="uname" required>
            <br>
          <label for="psw"><b>Senha</b></label>
            <br>
          <input type="password" placeholder="Digite sua senha" name="psw" required>
            <br>
          <button name="loginForm" type="submit">Login</button>
          <label>
            <input type="checkbox" onclick="" checked="checked" name="remember"> Lembre de mim
          </label>
        </div>
        <hr>
    </form>
    <?php } ?>
    <?php if(isset($newGif)) { ?>
      <h3>O arquivo pode ser acessado em <a href="<?=$newGif?>"><?=$newGif?></a></h3>
     <?php } ?>
    <div id="gifResize">
        <form name="formName">
        <?php if(!is_null($currentGif)) { ?>    
        <img src="<?= $currentGif ?>" alt="rendered image" id="rendered-image">
        <?php } ?>
        </form>
    </div>
    <div id="submission"></div>  
    <?php if(!is_null($loggedUser)) { ?>
          <form class="container" method="post" enctype="multipart/form-data">
            <p>
                <input type="file" onchange="renderFile()" name="filetag" accept="image/gif"> 
                    <br>
            </p>
            <p>
                <input type="submit" name="fileForm" value="Enviar" >
            </p>    
         </form>
    <?php } ?>   
    <script src="script.js"></script>
</body>
</html>