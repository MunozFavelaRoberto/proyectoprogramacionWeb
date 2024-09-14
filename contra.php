<?php session_start();
include "class/classBD.php";
$error=false;
  if (isset($_REQUEST['calculo']))
  { echo $_SESSION['captcha'];
    if ($_REQUEST['calculo']==$_SESSION['captcha'])
      {
        $bloque=$oBD->consulta("SELECT * from Usuario where Email='".$_POST['Email']."'");
        if($oBD->nume_Registros==1){ //cuenta si existe
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
            $mail->Subject = "Nueva Clave Acceso";
            $mail->MsgHTML("<h2> Tu nueva clave de acceso es: ".$nuevPWD."</h2>");
            $mail->AddAddress($_POST['Email']);
            $mail->Send();
            header("location: index.php?m=80");
          }
          else //cuenta no existe
            $error=1;//te equivocaste en el correo, el correo no existe.

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
  </div>

  <div class="container">
    <form method="POST" action="">
      <div class="row mt-4">

        <div class="col-6 rounded-3" style="border-style: solid !important; padding: 15px;">
        
        <legend>Recuperar Contraseña</legend>
        <? =$error;?>
        <span class=" badge bg-danger Handlee"> <?php if($error==1) echo "Ese correo no existe!"; else if($error==2) echo "Cálculo mal realizado!"; ?></span>

        <div class="row">
            <label class="col-md-3 Handlee">Email</label>
            <div class="col-md-9"><input type="email" name="Email" required="" class="form-control"
                placeholder="Ingrese su Email" >
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
            <div class="col-md-6"><small class="text-danger">Campo obligatorio
              </small></div>
            <div class="col-md-6">
              <button class="btn btn-success">Recuperar</button>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
  </div>
</body>

</html>