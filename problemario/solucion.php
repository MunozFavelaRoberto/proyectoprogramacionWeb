<?php
$datain=fopen('DatosEntrada.txt','r+');
$data=trim(fgets($datain));

while ($data!='end'){
    $flag = chkrPrim($data);
    switch ($flag){
        case 1:
            print "Primo".PHP_EOL;
        break;
        default:
            print "No Primo".PHP_EOL;
        break;
    }
    $data=trim(fgets($datain));
}

function chkrPrim($numero){
    if ($numero<=1){
        return 0;
    }
    for ($i=2;$i<=$numero/2;$i++){
        if ($numero%$i==0){
            return 0;
        }
    }
    return 1;
}
?>