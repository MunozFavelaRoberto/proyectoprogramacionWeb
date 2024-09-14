<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="CSS/bootstrap.css">
</head>
<body>
<?php include "recursos/menu.php";?>
  <div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Bienvenid@ a nuestro sitio de noticias</h1>
    <hr class="my-4" size="10">
  </div>
</div>
<?php
  if(isset($_GET['m']))
  switch($_GET['m']){
    case 1: echo '<h1>El correo '.$_GET['e'].', ya esta registrada, puedes recuperar la contraseña en la sección correspondiente.</h1>';
      break;
    case 7: echo '<h1>Se ha enviado al correo '.$_GET['e'].', tu clave de acceso.</h1>';
      break;
    case 80: echo '<h1>Hemos enviado tu nueva clave a tu correo</h1>';
    break;
    case '200': echo '<h3>Acceso Ilegal.</h3>';
  }
?>
</body>
</html>