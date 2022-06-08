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
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["filetag"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["filetag"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    } else {
      echo "batata";
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
    <div id="gifResize">
        <form name="formName">
            <img src="https://media.giphy.com/media/CNAhQuDceLwwo/giphy.gif" alt="rendered image" id="rendered-image">
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
                <input type="submit" name="submit" value="Enviar" >
            </p>    
         </form>
    <?php } ?>   
    <script src="script.js"></script>
</body>
</html>