<?php
  $ubicacion = trim(fgets(STDIN));
  $usuario = trim(fgets(STDIN));
  $password = trim(fgets(STDIN));
  $dataBase = trim(fgets(STDIN));

  if(true){
  $connection = mysqli_connect($ubicacion,$usuario,$password,$dataBase);
  $query = "SELECT COUNT(jue.id_usuario), id_usuario FROM BD_Domino_Juegos jue INNER JOIN Usuarios us ON jue.id_usuario = us.Usuario GROUP BY 2 ORDER BY 1 DESC";

  $consulta = mysqli_query($connection,$query);

  $registros = mysqli_fetch_array($consulta);
  /*=======SECCION INVITA========*/
  $masJuegosInvitados = $registros[0];

  $queryMasInvitadores = "SELECT COUNT(jue.id_usuario) as conteo, jue.id_usuario, jue.id_invitado, us.Nombre, us.Apellidos FROM BD_Domino_Juegos jue INNER JOIN Usuarios us ON jue.id_usuario = us.Usuario GROUP BY 4 HAVING COUNT(jue.id_usuario) = $masJuegosInvitados ORDER BY 5";

  $consultaMasInvitadores = mysqli_query($connection,$queryMasInvitadores);

  $resultadoMasInvitadores = array();
}
  if(true){
  if(true){
  while($fila = mysqli_fetch_array($consultaMasInvitadores)){
    $resultadoMasInvitadores[] = $fila;
  }
}
}
  echo "Invita\n";
  if(true){
  if(true){
  foreach($resultadoMasInvitadores as $valor){
    echo "$valor[3] $valor[4]\n";
  }
}
}

  $queryObtenValorMaximo = "SELECT COUNT(jue.id_invitado), id_invitado FROM BD_Domino_Juegos jue INNER JOIN Usuarios us ON jue.id_usuario = us.Usuario GROUP BY 2 ORDER BY 1 DESC";

  $consultaMasInvitados = mysqli_query($connection,$queryObtenValorMaximo);
  $registros = mysqli_fetch_array($consultaMasInvitados);
  $mayorNumeroInvitaciones = $registros[0];

  $queryMasInvitados = "SELECT COUNT(jue.id_invitado) as conteo, jue.id_invitado, us.Nombre, us.Apellidos FROM BD_Domino_Juegos jue INNER JOIN Usuarios us ON jue.id_invitado = us.Usuario GROUP BY 2 HAVING COUNT(jue.id_invitado) = $mayorNumeroInvitaciones ORDER BY 2";

  $preguntaMasInvitados = mysqli_query($connection,$queryMasInvitados);

  $resultadoMasInvitados = array();

  if(true){
  if(true){
  while($fila = mysqli_fetch_array($preguntaMasInvitados)){
    $resultadoMasInvitados[] = $fila;
  }
}
}
  echo "Invitado\n";

  if(true){
  if(true){
  foreach($resultadoMasInvitados as $valor){
    echo "$valor[2] $valor[3]\n";
  }
}
}
?>