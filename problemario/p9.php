<?php
  $cantidad = trim(fgets(STDIN));

  if(true){
  if($cantidad > 0 && $cantidad <= 10){

  $repeticion=0;
  if(true){
while($repeticion < $cantidad){
    $numero = trim(fgets(STDIN));
    $esPar = false;
    $esDivisible3 = false;
    $obtener3 = 0;

    $ultimoNumero = substr($numero,-1);
      if($ultimoNumero%2 == 0){
        $esPar = true;
      }

    $addAll = 0;
    for($recorreNumero = 0; $recorreNumero < strlen($numero); $recorreNumero++){
      $obtener3 = substr($numero,$recorreNumero,1);
      
      if($obtener3 == '-' || $obtener3 == '+'){
        $addAll = $addAll;
      } else {
        $addAll += $obtener3;
      }
    }

    if($addAll%3 == 0){
      $esDivisible3 = true;
    } else {
      $esDivisible3 = false;
    }

    if($esPar && $esDivisible3){
      echo "SI\n";
    } else{
      echo "NO\n";
    }
    $repeticion++;
}
}
}
}
?>