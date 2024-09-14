<?php
if(true){
  do{
      if(true){
          if(true){
    $barcode = trim(fgets(STDIN));
    $longitudBarcode = strlen($barcode);

    switch($barcode){
        case '0':
            exit();
            break;
        default:
        if($longitudBarcode%2==1){
            $primerNumero = substr($barcode,0,1);
            $ultimoNumero= substr($barcode,-1,1);
            if($primerNumero == $ultimoNumero){
              echo "INCORRECTO IMPAR\n";
            } else {
              $multiplicacionNumeros = ($primerNumero * $ultimoNumero);
              $resultadoRestaAbsoluta = abs($primerNumero - $ultimoNumero);
              
              $posicionEnMedio = ceil($longitudBarcode/2);
              $numeroEnMedio = substr($barcode,($posicionEnMedio-1),1);
            
              $residuo = ($multiplicacionNumeros%$resultadoRestaAbsoluta);
              if($residuo == $numeroEnMedio){
                echo "CORRECTO IMPAR\n";
              } else {
                echo "INCORRECTO IMPAR\n";
              }
            }
          } else {
            
            $longitudGrupos = ($longitudBarcode/2);
    
            $grupoIzquierda = substr($barcode,0,$longitudGrupos);
            $grupoDerecha = substr($barcode, -$longitudGrupos);
      
            $sumaGrupoIzq = 0;
            $sumaGrupoDer = 0;
    
            $recorreGrupo=0;
            do{
              $indexIzq = substr($grupoIzquierda,$recorreGrupo,1);
              $sumaGrupoIzq += $indexIzq;
      
              $indexDer = substr($grupoDerecha, $recorreGrupo, 1);
              $sumaGrupoDer += $indexDer;
    
              $recorreGrupo++;
            }while($recorreGrupo < $longitudGrupos);
      
            $mascaraAnd = $sumaGrupoIzq & $sumaGrupoDer;
      
            if($mascaraAnd%2 == 1){
              echo "CORRECTO PAR\n";
            } else {
              echo "INCORRECTO PAR\n";
            }
          }
    }
}
}
  }while($barcode != '0');
}
?>