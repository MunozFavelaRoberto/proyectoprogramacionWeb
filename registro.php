<?php session_start();
include "class/classBD.php";
$error=false;
  if (isset($_REQUEST['calculo']))
  { echo $_SESSION['captcha'];
    if ($_REQUEST['calculo']==$_SESSION['captcha'])
      {
        $bloque=$oBD->consulta("SELECT * from Usuario where Email='".$_POST['Email']."'");
        if($oBD->nume_Registros==1){ //cuenta si existe
          $error=1;//te equivocaste en el correo, el correo no existe.
          }
          else //cuenta no existe
            
            $cadena="abcdhjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ2345678923456789";
        $numeC=strlen($cadena);
        $nuevPWD="";
        for ($i=0; $i<10; $i++)
         $nuevPWD.=$cadena[rand()%$numeC]; 
         
         $oBD->consulta("UPDATE Usuario set Password='".$nuevPWD."' where Email='".$_POST['Email']."'");
         
         include("recursos/class.phpmailer.php");
         include("recursos/class.smtp.php");
          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->Host="smtp.gmail.com";
          $mail->SMTPSecure = 'ssl'; 
          $mail->Port = 465; 
          $mail->SMTPDebug  = 0;
            $mail->SMTPAuth = true; 
            $mail->Username =   "18030061@itcelaya.edu.mx"; 
            $mail->Password = "18030061666r"; 
            $mail->Subject = "Registro completado, tu nueva clave de acceso";
            $mail->MsgHTML("<h2> Tu nueva clave de acceso es: ".$nuevPWD."</h2>");
            $mail->AddAddress($_POST['Email']);
            $mail->Send();
            header("location: index.php?m=80");

        }
    else
      $error=2;//te equivocaste en el calculo del captcha.
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Document</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  <link rel="stylesheet" href="CSS/bootstrap.css">
</head>

<body>
<?php include "recursos/menu.php";?>
  
  <div class="container">
    <form method="POST" action="recursos/registrarse.php">
      <div class="row mt-4">

        <div class="col-6 rounded-3" style="border-style: solid !important; padding: 15px;">
          <div class="row">

          <legend>Registro de usuario</legend>
        <? =$error;?>
        <span class=" badge bg-danger Handlee"> <?php if($error==1) echo "Ese correo ya esta en uso!"; else if($error==2) echo "Cálculo mal realizado!"; ?></span>

            <label class="col-md-3 Handlee">Email</label>
            <div class="col-md-9"><input type="text" name="Email" placeholder="Ingrese su correo" required
                class="form-control"></div>
          </div>

          <div class="row">
            <label class="col-md-3 Handlee">Nombre</label>
            <div class="col-md-9"><input type="Nombre" name="Nombre" placeholder="Ingrese sus nombres" required
                class="form-control">
            </div>
          </div>

          <div class="row">
            <label class="col-md-3 Handlee">Apellidos</label>
            <div class="col-md-9"><input type="text" name="Apellidos" placeholder="Ingrese sus apellidos" required
                class="form-control">
            </div>
          </div>

          <div class="row">
            <label class="col-md-2 Handlee">Genero</label>
            <div class="col-sm-10"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Femenino</label><input type="radio" name="Genero" value="F" >
              <label>Masculino</label><input type="radio" name="Genero" value="M" >
              <label>Otro</label><input type="radio" name="Genero" value="O" >
            </div>
          </div>

          <?php
        $n1=rand()%10+1;
        do{ $n2=rand()%10+1;}while($n1==$n2);//mientras n1 y n2 sean iguales, entonces vuelve a darme otro numero random.
        $n3=rand()%10+1;
        do{ $n4=rand()%10+1;}while($n3==$n4);
        $op1=(rand()%10000>5000)?"+":"-";
        $op2=(rand()%10000>5000)?"+":"-";
              $cad="(".$n1.$op1.$n2.') * ('.$n3.$op2.$n4.")";
              $_SESSION['captcha']=($op1=='+')? $n1+$n2: $n1-$n2;
              $_SESSION['captcha']*=($op2=='+')? $n3+$n4: $n3-$n4;
        ?>

          <div class="row">
            <label class="col-md-3 Handlee">Cuanto es?</label>
            <div class="col-md-9"><input type="text" name="calculo" required="" class="form-control"
                placeholder="<?php echo $cad; ?>" >
            </div>
          </div>
          
          
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <div class="row">
            <div class="col-md-6"><small class="text-danger">Campos obligatorios
              </small></div>
            <div class="col-md-6">
              <button class="btn btn-success">Registrarme</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
  
</body>

</html>