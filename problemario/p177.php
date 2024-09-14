<?php
$caracDom = "-_.abcdefghijklmnopqrstuvwxyzABCDEFGHJIJKLMNOPQRSTUVWXYZ";
$caracUsu = "$#%.-_ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
$datIngr = trim(fgets(STDIN));
for ($recoCorr = 0; $recoCorr < $datIngr; $recoCorr++) {
  $nomLoc = '';
  $nomDomi = '';

  $esCorreDomi = false;
  $esCorreUsu = false;
  $tieneDomi = false;
  $correoElectronico = trim(fgets(STDIN));

$posicionCaracterEmail=0;
  while($posicionCaracterEmail < strlen($correoElectronico)){
  if (substr($correoElectronico, $posicionCaracterEmail, 1) == '@') {
    $tieneDomi = true;
    $nomDomi .= substr($correoElectronico, $posicionCaracterEmail + 1, strlen($correoElectronico));
    $nomLoc = substr($correoElectronico, 0, $posicionCaracterEmail);
  }
  $posicionCaracterEmail++;
}

  $posicionCaracterDominio=0;
  while($posicionCaracterDominio < strlen($nomDomi)){
    if (substr($nomDomi, $posicionCaracterDominio, 1) == '@') {
      $esCorreDomi = false;
      break;
    } else {
      if (substr($nomDomi, $posicionCaracterDominio, 1) == '.' && substr($nomDomi, $posicionCaracterDominio + 1, 1) == '.' || $nomDomi == ' ') {
        $esCorreDomi = false;
      }
      if(strpos($caracDom, substr($nomDomi, $posicionCaracterDominio, 1)) === false){
        $esCorreDomi = false;
      break;
      }
      $esCorreDomi = true;
      
    }
    $posicionCaracterDominio++;
  }

  switch(strlen($nomLoc)){
      case 0:
        $esCorreUsu = false;
        break;
      default: 
      for ($posicionCaracterNombreLocal = 0; $posicionCaracterNombreLocal < strlen($nomLoc); $posicionCaracterNombreLocal++) {
        $posicionMas = $posicionCaracterNombreLocal+1;
        if(substr($nomLoc, $posicionCaracterNombreLocal, 1) == '.'){
            if(substr($nomLoc, $posicionMas, 1) == '.'){
              $esCorreUsu = false;
            }
            break;
        } else if(substr($nomLoc, $posicionCaracterNombreLocal, 1) == ' '){
          $esCorreUsu = false;
          break;
        } else {
          $esCorreUsu = true;
        }
      }
  }

  if (!$tieneDomi || !$esCorreDomi) {
    echo "DOMINIO INCORRECTO\n";
  } elseif ($esCorreUsu && $esCorreDomi) {
    echo $nomDomi . "\n";
  } elseif (!$esCorreUsu) {
    echo "USUARIO INCORRECTO\n";
  }

}
?>