<?php
$casos=trim(fgets(STDIN));
// $cont=0;
// while ( $cont !=$casos ) {
//     $cont++;
//     $caso[$cont]=trim(fgets(STDIN));
//     echo q0($caso[$cont]);
// }

if(true){
for($cont=0;$cont !=$casos;$cont++){
    $caso[$cont]=trim(fgets(STDIN));
    echo q0($caso[$cont]);
}
}

function q0($pildoras){
    $vaso=0;
    $pedido=0;
    $orden='';
    $ordenes=explode(" ", $pildoras);
    foreach (array_slice($ordenes,1) as  $clave=>$value) {
    $vaso+=$value;
        $pedido++;
        if ($vaso<100){           
        }else{
            $vaso-=100;
            $orden.=$pedido." ";
            $pedido=0;
        }

        switch($vaso){
            case 0: break;

        }
    }
    echo $orden."\n";
}
 ?> 