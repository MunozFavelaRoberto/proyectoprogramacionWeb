<?php
  $ubicacion = trim(fgets(STDIN));
  $usuario = trim(fgets(STDIN));
  $password = trim(fgets(STDIN));
  $dataBase = trim(fgets(STDIN));

  $connection = mysqli_connect($ubicacion,$usuario,$password,$dataBase);
  $query = "SELECT id, us.Nombre as NombreUs, us.Apellidos as ApellidoUs, usi.Nombre as NombreUsi, usi.Apellidos as ApellidoUsi, jue.secuencia FROM juegos jue INNER JOIN usuarios us ON jue.id_usuario = us.Usuario INNER JOIN usuarios usi ON jue.id_invitado = usi.Usuario WHERE jue.secuencia > '' AND jue.id_estatus = 1 ORDER BY 1";

  $mandaConsulta = mysqli_query($connection,$query);

  //$sacaDatos = mysqli_fetch_array($mandaConsulta);

  $obtieneDatosIndividuales = array();

  while($fila = mysqli_fetch_array($mandaConsulta)){
    $obtieneDatosIndividuales[] = $fila;
  }
  
  print_r($obtieneDatosIndividuales);
  foreach($obtieneDatosIndividuales as $valor){
    $secuencia = $valor[5];

    $id_juego = $valor[0];
    $nombreInvita = $valor[1];
    $apellidoInvita = $valor[2];
    $nombreInvitado = $valor[3];
    $apellidoInvitado = $valor[4];

    if($secuencia != ""){
      $esSecuenciaMala = false;
      $esFichaDuplicada = false;
      $existeError = false;
      $fichas = explode(" ",$secuencia);

      /* =====COMPRUEBA SECUENCIA====== */
      for($recorreFichas = 0; $recorreFichas < count($fichas)-1; $recorreFichas++){
        $ficha = $fichas[$recorreFichas];
        $fichaProxima = $fichas[$recorreFichas+1];
        if($ficha[2] != $fichaProxima[0]){
          $esSecuenciaMala = true;
          $existeError = true;
          //echo "ID_JUEGO: $id_juego -> Secuencia Mala: $ficha[0]:$ficha[2] != $fichaProxima[0]:$fichaProxima[2]\n";
        }
      }

      /* ======COMPRUEBA DUPLICIDAD====== */
      for($recorreFichas = 0; $recorreFichas < count($fichas)-1; $recorreFichas++){
        $fichaPivote = $fichas[$recorreFichas];
        for($compruebaDuplicidad = $recorreFichas+1; $compruebaDuplicidad < count($fichas); $compruebaDuplicidad++){
          $fichaAComprobar = $fichas[$compruebaDuplicidad];
         // echo "ID_JUEGO: $id_juego -> Se comprueba: $fichaPivote & $fichaAComprobar\n";
          if($fichaPivote == $fichaAComprobar){
            $esFichaDuplicada = true;
            $existeError = true;
            //echo "ID_JUEGO: $id_juego -> Hay duplicidad: $fichaPivote & $fichaAComprobar\n";
          }
        }
      }
      //echo "$id_juego: $secuencia\n";
    }
    if($esFichaDuplicada && $existeError){
      echo "$id_juego:$nombreInvita $apellidoInvita:$nombreInvitado $apellidoInvitado:Ficha Duplicada\n";
    } else if($esSecuenciaMala && $existeError){
      echo "$id_juego:$nombreInvita $apellidoInvita:$nombreInvitado $apellidoInvitado:Secuencia Mal\n";
    } else if($esSecuenciaMala && $esFichaDuplicada && $existeError){
      echo "$id_juego:$nombreInvita $apellidoInvita:$nombreInvitado $apellidoInvitado:Ficha Duplicada\n";
    }
    

    //echo "$id_juego:$nombreInvita:\n";
  }
  //print_r($sacaDatos);

/*
localhost
elMejor
1234
dominopractica
*/
?>