<?php
include "../class/classBD.php";
$bloqueRegistros=$oBD->consulta("SELECT * from Usuario where Email='".$_POST['Email']."'");
if ($oBD->nume_Registros==0)//oBD= objetos de la BD
{ 
$cadena="abcdhjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ2345678923456789";
$numeC=strlen($cadena);
$nuevPWD="";
for ($i=0; $i<10; $i++)
  $nuevPWD.=$cadena[rand()%$numeC]; 
 include("class.phpmailer.php");
 include("class.smtp.php");
$mail = new PHPMailer();
$mail->IsSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;     
    $mail->SMTPDebug  = 0;  //Recuerda pornerlo en 0 cuando ya se haya conluido con la parte de correos.
    $mail->SMTPAuth = true; 
    $mail->Username =   "18030061@itcelaya.edu.mx";
    $mail->Password = "18030061666r";
    $mail->From="";
    $mail->FromName="";
    $mail->Subject = "Registro completo";
    $mail->MsgHTML("<h1>BIENVENIDO ".$_POST['Nombre']." ".$_POST['Apellidos']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
    $mail->AddAddress($_POST['Email']);
    //$mail->AddAddress("admin@admin.com");
    if (!$mail->Send()) 
          echo  "Error: " . $mail->ErrorInfo;
    else { 
            $cad="Insert into usuario set Nombre='".$_POST['Nombre']."', Apellidos='".$_POST['Apellidos']."', Email='".$_POST['Email']."', Password='".$nuevPWD."', Genero='".$_POST['Genero']."', ContAccesos=0, FechUltimoAcceso='".Date("Y-m-d H:i:s")."',Foto='',IdTipoUsuario=3;";
            $oBD->consulta($cad);
            if ($oBD->mensError=="")
                  header("location: ../index.php?m=7&e=".$_POST['Email']); 
            else
                  echo $mensError." ".$cad;
         }
}
else
header("location: ../index.php?m=1&e=".$_POST['Email']);
/*

PROBLEMAS A SOLUCIONAR EN EL REGISTRO
1) DETECTAR QUE EL CORREO YA ESTA REGISTRADO, 
   YA QUE ES LA LLAVE PRIMARIA Y NO SE DEBE ENVIAR
   EL CORREO SI YA ESTABA REGISTRADO.
2) LA CLAVE DEBE DE CIFRARSE, POR QUE EN EL 
   LOGUEO SE CIFRA.


*/











?>