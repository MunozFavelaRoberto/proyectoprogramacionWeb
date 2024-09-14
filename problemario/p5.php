<?php
while(true){
    $datosIngresador = trim(fgets(STDIN));
  switch($datosIngresador){
        case "-1":
            exit(0);
            break;
        default:
        $datosSeparados = explode(" ", $datosIngresador);
    $RPM = $datosSeparados[0];
    if($datosSeparados[1] < 0 || $datosSeparados[1] > 15){
      exit(0);
    } else {
      for($recorreNumeroEngranajes = 2; $recorreNumeroEngranajes < count($datosSeparados)-1; $recorreNumeroEngranajes++){
        $valor1 = $datosSeparados[$recorreNumeroEngranajes] * $RPM;
        
        $RPM = $valor1 / $datosSeparados[$recorreNumeroEngranajes+1];
      }
      print $RPM."\n";
    }
  }
}
?>