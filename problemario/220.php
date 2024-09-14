<?php
setlocale(LC_MONETARY, 'en_US');
$contador=0;
$arreglo[]='';
fscanf(STDIN, "%s", $s);
fscanf(STDIN, "%s", $u);
fscanf(STDIN, "%s", $p);
fscanf(STDIN, "%s", $bd);
// $cone=mysqli_connect("localhost","root","","pagoservicios");
$cone=mysqli_connect($s,$u,$p,$bd);
if ($cone) {
    $cad='SELECT  sum(datos.monto) as monto from (SELECT
    if(f.id in (SELECT f.id FROM BD_PagoServ_Facturas f
       INNER JOIN BD_PagoServ_Servicios s on f.id_Servicio=s.id
       WHERE  f.id in (SELECT id FROM BD_PagoServ_Facturas WHERE ((fecha_Pago>fecha_Vencimiento ) or (fecha_Pago  LIKE "0000-00-00")))
       and (f.fecha_Vencimiento<"2019-01-20")
       GROUP by 1)  , sum(f.Monto) ,0 ) as monto from BD_PagoServ_Facturas f
        GROUP by f.id ORDER by 1) as datos';
    
    $bloque=mysqli_query($cone,$cad);
    
    if (mysqli_num_rows($bloque)!=0){
        $totaladeudosusuarios=mysqli_fetch_array($bloque);
        $money=$totaladeudosusuarios['monto'];
        echo 'Total de Adeudos: $'.number_format($money,2).PHP_EOL;
        
        $cad2='SELECT datos.id_Cliente ,sum(datos.Monto) as Monto from (SELECT u.Apellidos, u.Nombre,f.id_Cliente,sum(f.Monto) as Monto from BD_PagoServ_Facturas f
    left join Usuarios u on f.id_Cliente = u.Usuario
    WHERE  f.id in (SELECT id FROM BD_PagoServ_Facturas WHERE ((fecha_Pago>fecha_Vencimiento ) or (fecha_Pago  LIKE "0000-00-00")))
        and (f.fecha_Vencimiento<"2019-01-20")
         group by 1
         ) as datos group by datos.id_Cliente order by datos.Apellidos asc';
         $bloque2=mysqli_query($cone,$cad2);
         
         while ($usuarios_con_adeudo=mysqli_fetch_object($bloque2)) {
            // echo $usuarios_con_adeudo['id_Cliente'];
             $cad3="SELECT Nombre, Apellidos from Usuarios where Usuario= '$usuarios_con_adeudo->id_Cliente'";
             $bloque3=mysqli_query($cone,$cad3);
             if (mysqli_num_rows($bloque)!=0){
             $nombre=mysqli_fetch_array($bloque3);
             $apellidos=$nombre['Apellidos'];
             $nombres=$nombre['Nombre'];
             $adeudo_Total_Usuario=$usuarios_con_adeudo->Monto;
             echo 'Cliente: '.$apellidos.' '.$nombres.' Total de Adeudo: $'.money_format('%i',$adeudo_Total_Usuario)."\n";
             

             $cad4="SELECT datos.id_Cliente , datos.Monto as Monto, datos.fecha_Vencimiento, datos.servicio from (SELECT f.id_Cliente, f.Monto as Monto, fecha_Vencimiento, bps.Nombre as servicio  from BD_PagoServ_Facturas f
             join BD_PagoServ_Servicios bps on bps.id = f.id_Servicio
             WHERE  f.id in (SELECT id FROM BD_PagoServ_Facturas WHERE ((fecha_Pago>fecha_Vencimiento ) or (fecha_Pago  LIKE '0000-00-00')))
             and (f.fecha_Vencimiento<'2019-01-20')
                           ) as datos where id_Cliente='$usuarios_con_adeudo->id_Cliente'
                                order by datos.fecha_Vencimiento ASC";
            $bloque4=mysqli_query($cone,$cad4);
            while($resultado=mysqli_fetch_object($bloque4)){    
                echo 'Servicio: ' .$resultado->servicio.' Total: $'.money_format('%i',$resultado->Monto).' Fecha Venc.: '.$resultado->fecha_Vencimiento."\n";
        }
             }
         }   
     }
    }

?>