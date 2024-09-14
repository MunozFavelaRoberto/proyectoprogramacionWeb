<?php
    $ubicacion = trim(fgets(STDIN));
    $usuario = trim(fgets(STDIN));
    $password = trim(fgets(STDIN));
    $dataBase = trim(fgets(STDIN));

    $connection = mysqli_connect($ubicacion,$usuario,$password,$dataBase);

$query1 = "SELECT DATE_FORMAT(Fecha,'%d/%b/%Y') as Fecha, concat('$',FORMAT(Apuesta,2)) as Apuesta FROM BD_Apuesta WHERE Apuesta = (SELECT MAX(Apuesta) FROM BD_Apuesta)";
$query2 = "SELECT CONCAT(U.Nombre,' ',U.Apellidos) AS nombre, (((SELECT SUM(Apuesta) FROM BD_Apuesta B WHERE B.IdGanador = U.Usuario) * .9)-(SELECT SUM(Apuesta) FROM BD_Apuesta B WHERE (B.Retador = U.Usuario OR B.Invitado = U.Usuario) AND B.IdGanador != U.Usuario)) AS pedidos FROM Usuarios U INNER JOIN BD_Apuesta ON U.Usuario = BD.Retador OR U.Usuario = BD.Invitado OR U.Usuario = BD.IdGanador HAVING(perdidos) order by perdidos asc LIMIT 1;";
$query3 = "SELECT CONCAT(r.Nombre,' ',r.Apellidos) as Retador, CONCAT(i.Nombre,' ',i.Apellidos) as Invitado, CONCAT(g.Nombre,' ',g.Apellidos) as Ganador FROM BD_Apuesta b JOIN Usuarios r ON b.Retador = r.Usuario JOIN Usuarios i ON b.Invitado = i.Usuario JOIN Usuarios g ON b.Invitado = g.Usuario WHERE Apuesta = (SELECT MAX(Apuesta ) FROM BD_Apuesta)";
$query4 = "SELECT concat('$',FORMAT(SUM(Apuesta*.10),2)) as Apuesta FROM BD_Apuesta";
$query5 = "SELECT concat('$',FORMAT(SUM(Apuesta),0)) as Ganancia FROM BD_Apuesta where weekday(Fecha)=6 or weekday(Fecha)=5;";
$query6 = "SELECT Cuentas_Bancarias.Id as Id, Banco, CONCAT(Nombre,' ',Apellidos) as Nombre, CHAR_LENGTH(CLABE) as CLABE FROM Cuentas_Bancarias join Usuarios u on u.Usuario = Cuentas_Bancarias.IdUser join Bancos b on b.Id = Cuentas_Bancarias.IdBanco where CHAR_LENGTH(CLABE)!=18 and CHAR_LENGTH(CLABE)!=16";
$query7 = "SELECT CONCAT(Nombre,' ',Apellidos) as User, Banco, Saldo FROM Cuentas_Bancarias C join Usuarios U on U.Usuario=C.IdUser join Bancos B on B.IdBanco=C.IdBanco order by Saldo asc LIMIT 1;";

    $consulta1 = mysqli_query($connection,$query1);
    if(mysqli_num_rows($consulta1) > 0)
    {
        while($fila = mysqli_fetch_assoc($consulta1))
        {
            echo $fila['Fecha']." ".$fila['Apuesta']."\n";
        }
    }else
    {
        echo "\n";
    }

    if($resultado2 = mysqli_query($connection,$query2)){
      while($fila2=mysqli_fetch_row($resultado2)){
        echo $fila2[0]." $".$fila2[1]."00" . PHP_EOL;
      }
      mysqli_free_result($resultado2);
    }

    $consulta3 = mysqli_query($connection,$query3);
    if(mysqli_num_rows($consulta3) > 0)
    {
        while($fila = mysqli_fetch_assoc($consulta3))
        {
            echo $fila['Retador']." vs ".$fila['Invitado']." ".' gano '." ".$fila['Ganador']."."."\n";
            echo "\n";
        }
    }else
    {
        echo "\n";
    }

    $consulta4 = mysqli_query($connection,$query4);
    if(mysqli_num_rows($consulta4) > 0)
    {
        while($fila = mysqli_fetch_assoc($consulta4))
        {
            echo $fila['Apuesta']."\n";
        }
    }else
    {
        echo "\n";
    }

    $consulta5 = mysqli_query($connection,$query5);
    if(mysqli_num_rows($consulta5) > 0)
    {
        while($fila = mysqli_fetch_assoc($consulta5))
        {
            echo $fila['Ganancia']."\n";
        }
    }else
    {
        echo "\n";
    }

    $consulta6 = mysqli_query($connection,$query6);
    if(mysqli_num_rows($consulta6) > 0)
    {
        while($fila = mysqli_fetch_assoc($consulta6))
        {
          echo $fila['Id']." ".$fila['Banco']." ".$fila['Nombre']." ".$fila['CLABE']." : ";
        }
        echo "\n";
    }else
    {
        echo "\n";
    }

    if($resultado7 = mysqli_query($connection,$query7)){
      while($fila7=mysqli_fetch_row($resultado7)){
        echo $fila7[0]." ".$fila7[1]." $".$fila7[2] . PHP_EOL;
      }
      mysqli_free_result($resultado7);
    }
?>