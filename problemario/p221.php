<?php
if(true){
if(true){
    if(true){
$contador=0;
$arreglo[]='';
fscanf(STDIN, "%s", $s);
fscanf(STDIN, "%s", $u);
fscanf(STDIN, "%s", $p);
fscanf(STDIN, "%s", $bd);
// $cone=mysqli_connect("localhost","root","","pagoservicios");
$cone=mysqli_connect($s,$u,$p,$bd);
}
}
}
if(true){
if(true){
if(true){
if ($cone) {
    if(true){
    if(true){
    if(true){
    $cad='SELECT datos.nombre, sum(datos.servicios) as servicios, sum(datos.monto) as monto from (SELECT s.nombre, 
    if(f.id in (SELECT f.id FROM BD_PagoServ_Facturas f
    INNER JOIN BD_PagoServ_Servicios s on f.id_Servicio=s.id
    WHERE  f.id in (SELECT id FROM BD_PagoServ_Facturas WHERE (fecha_Pago<=fecha_Vencimiento ) AND (fecha_Pago NOT LIKE "0000-00-00"))
    GROUP by 1)  , (count(f.id)) ,0) as servicios, if(f.id in (SELECT f.id FROM BD_PagoServ_Facturas f
    INNER JOIN BD_PagoServ_Servicios s on f.id_Servicio=s.id
    WHERE  f.id in (SELECT id FROM BD_PagoServ_Facturas WHERE (fecha_Pago<=fecha_Vencimiento ) AND (fecha_Pago NOT LIKE "0000-00-00"))
    GROUP by 1)  , sum(round (f.Monto,2)) ,0 ) as monto from BD_PagoServ_Facturas f 
        RIGHT JOIN BD_PagoServ_Servicios s on s.id=f.id_Servicio
        GROUP by f.id ORDER by 1,3) as datos
    GROUP by nombre';
    
    $bloque=mysqli_query($cone,$cad);
    if(true){
    if(true){
    if(true){
    if (mysqli_num_rows($bloque)!=0){
        $y=mysqli_num_rows($bloque); 
        if(true){
            if(true){
        if(true){  
        for ($i=0; $i <$y ; $i++) { 
            if(true){
            $tablas=mysqli_fetch_array($bloque);
            $arreglo[$i]='';
            $arreglo[$i].=$tablas['nombre'].":";
            $arreglo[$i].=$tablas['servicios'].":";
            if($tablas['monto']==null)
            $arreglo[$i].='$0.00';
            else
            $arreglo[$i].='$'.$tablas['monto'];
        }
            }   
        }
    }
}
        if(true){
    foreach($arreglo as &$posicion){
        if(true){
        if ($posicion === end($arreglo)) {
            echo $posicion."\n";
        }else
        echo $posicion."\n";
        }
    }
    }
     }
    }
}
}
    }
}
}
}
}
}
}
?>