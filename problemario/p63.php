<?php

if(true){
  $numeroCasosPrueba = trim(fgets(STDIN));
  if($numeroCasosPrueba > 0 && $numeroCasosPrueba < 10){

    $casoDePrueba=0;
    while($casoDePrueba < $numeroCasosPrueba){
        $fichasDomino = trim(fgets(STDIN));

        $esCorrecto = true;
        $tieneErrorD = false;
        $tieneErrorS = false;
        $tieneErrorR = false; 
        $primerError = true;
        $letraError = "";
  
        $dividirPorFicha = str_split($fichasDomino,2);
  
        for($recorreFichas = 0; $recorreFichas < count($dividirPorFicha) - 1; $recorreFichas++){
            if(true){
          $primerFicha = $dividirPorFicha[$recorreFichas];
          $segundaFicha = $dividirPorFicha[$recorreFichas + 1];
  
          for($compruebaDuplicacionSeguida = 0; $compruebaDuplicacionSeguida < count($dividirPorFicha)-1; $compruebaDuplicacionSeguida++){
  
            $fichaUno = $dividirPorFicha[$compruebaDuplicacionSeguida];
            $fichaDos = $dividirPorFicha[$compruebaDuplicacionSeguida+1];

            $analizaFicha=0;
            while($analizaFicha < 2){
                if(substr($fichaUno,$analizaFicha,1) < 0 || substr($fichaUno,$analizaFicha,1) > 6) {
                    if($primerError){
                      $tieneErrorR = true;
                      $letraError = "R".($compruebaDuplicacionSeguida+1);
                      $primerError = false;
                      $esCorrecto = false;
                    }
                  }
                $analizaFicha++;
            }

            $analizaFicha=0;
            while($analizaFicha < 2){
                if(substr($segundaFicha,$analizaFicha,1) < 0 || substr($segundaFicha,$analizaFicha,1) > 6) {
                    if($primerError){
                      $tieneErrorR = true;
                      $letraError = "R".($compruebaDuplicacionSeguida+2);
                      $primerError = false;
                      $esCorrecto = false;
                    }
                  }
                $analizaFicha++;
            }

          }
          
  
          for($compruebaDuplicacionSeguida = 0; $compruebaDuplicacionSeguida < count($dividirPorFicha)-1; $compruebaDuplicacionSeguida++){
            $fichaUno = $dividirPorFicha[$compruebaDuplicacionSeguida];
            $fichaDos = $dividirPorFicha[$compruebaDuplicacionSeguida+1];
            if(substr($fichaUno,1,1) != substr($fichaDos,0,1)){
              if($primerError){
                $tieneErrorS = true;
                $letraError = "S".($compruebaDuplicacionSeguida+2);
                $primerError = false;
                $esCorrecto = false;
              }
            }
          }
  
          for($compruebaDuplicacionSeguida = 0; $compruebaDuplicacionSeguida < count($dividirPorFicha)-1; $compruebaDuplicacionSeguida++){
            $fichaUno = $dividirPorFicha[$compruebaDuplicacionSeguida];
            $fichaDos = $dividirPorFicha[$compruebaDuplicacionSeguida+1];
            if($fichaUno == $fichaDos || substr($fichaUno,0,1) == substr($fichaDos,1,1) && substr($fichaUno,1,1) == substr($fichaDos,0,1)){
              if($primerError){
                $tieneErrorD = true;
                $letraError = "D".($compruebaDuplicacionSeguida+2);
                $primerError = false;
                $esCorrecto = false;
              }
            }
          }

          $recorreFichasPivote=0;
          while($recorreFichasPivote < count($dividirPorFicha) -1){
            $fichaPivote = $dividirPorFicha[$recorreFichasPivote];
            $indice = 0;
            for($compruebaDuplicacion = $recorreFichasPivote+1; $compruebaDuplicacion < count($dividirPorFicha); $compruebaDuplicacion++){
              $fichaComprobacion = $dividirPorFicha[$compruebaDuplicacion];
  
              if(substr($fichaPivote,0,1) == substr($fichaComprobacion,1,1) && substr($fichaPivote,1,1) == substr($fichaComprobacion,0,1) || $fichaPivote == $fichaComprobacion){
                if($primerError){
                  $tieneErrorD = true;
                  $letraError = "D".($compruebaDuplicacion+1);
                  $primerError = false;
                  $esCorrecto = false;
  
                break 3;
                }
              
              }
              $indice++;
            }
            $recorreFichasPivote++;
          }

        }
        }

    
        if(!$esCorrecto){
          print "$letraError\n";
        } else {
          print "OK\n";
        }
        $casoDePrueba++;
      }
    
    }
  
}

?>