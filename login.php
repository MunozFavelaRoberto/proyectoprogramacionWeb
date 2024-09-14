<?php
session_start();
  include "class/classBD.php";
  $error=false;
  if (isset($_POST['email']))
  {
    $registro=$oBD->obtenRegistro("SELECT * from Usuario where Email='".$_POST['email']."' and Password=password('".$_POST['password']."');");
    if($oBD->nume_Registros)
    {
      $_SESSION['Nombre']=$registro->Nombre." ".$registro->Apellidos;
      $_SESSION['IdUser']=$registro->IdUsuario;
      $_SESSION['tipoUser']=$registro->IdTipoUsuario;
      $_SESSION['Foto']=$registro->Foto;
      if($registro->IdTipoUsuario==1)
          header("location: admin/");
      else
          if($registro->IdTipoUsuario==2)
            header("location: reporteros/");
          else
            header("location: users/");
  }
  else
    $error=true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Document</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  <link rel="stylesheet" href="CSS/bootstrap.css">
  <style>
    @import url('https//fonts.googleapis.com/css2?family=Handlee&display=swap');
  </style>
</head>

<body>
<?php include "recursos/menu.php";?>

  <div class="container">
    <?php if($error){ ?>
      <div class="row"><div class="col-md-4"><span class="badge bg-danger">Datos Incorrectos!</span></div></div>
      <?php } ?>

    <form method="POST">
      <div class="row mt-4">

        <div class="col-6 rounded-3" style="border-style: solid !important; padding: 15px;">
          <div class="row">

            <label class="col-md-3 Handlee">email</label>
            <div class="col-md-9"><input type="text" name="email" placeholder="Ingrese su correo" required
                class="form-control"></div>
          </div>

          <div class="row">
            <label class="col-md-3 Handlee">Password</label>
            <div class="col-md-9"><input type="password" name="password" placeholder="Ingrese su clave" required
                class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <div class="row">
            <div class="col-md-6"><small class="text-danger">Ambos campos son obligatorios
              </small></div>
            <div class="col-md-6">
              <button class="btn btn-success">Ingresar</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
  </div>
</body>
</html>