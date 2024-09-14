<?php
$conexion=trim(fgets(STDIN));
$conexion=explode(" ", $conexion);
    $s=$conexion[0];
    $u=$conexion[1];
    $p=$conexion[2];
    $bd=$conexion[3]; 
    $cone=mysqli_connect($s,$u,$p,$bd);

if ($cone) {
    for ($nDatos=0; $nDatos <10 ; $nDatos++) { 
        $usuario_Pass[$nDatos]=trim(fgets(STDIN));
        $usuario_Pass[$nDatos]=explode(" ", $usuario_Pass[$nDatos]); 
        sacar_Usuario($usuario_Pass[$nDatos][0],$usuario_Pass[$nDatos][1],$cone);
    }
}
function sacar_Usuario($usuario,$password,$cone){
    $cad="SELECT Usuario, Nombre, Apellidos, PASSWORD(Clave)
    from (SELECT Ref_Bancaria,id_Cliente from BD_PagoServ_Facturas where (id_FormaPago=2 )) as datos
    right join Usuarios u on u.Usuario=datos.id_Cliente
    WHERE (u.Usuario='$usuario' and u.Clave=PASSWORD('$password'))";
    $bloque=mysqli_query($cone,$cad);
    if (mysqli_num_rows($bloque)!=0) {
        $datos_Usuario=mysqli_fetch_object($bloque);
        $cad2="SELECT f.Ref_Bancaria from BD_PagoServ_Facturas f
            where (id_FormaPago=2 and id_Cliente='$datos_Usuario->Usuario') ORDER BY f.Ref_Bancaria ASC";
        $bloque2=mysqli_query($cone,$cad2);
        if (mysqli_num_rows($bloque2)!=0) {
        echo  ($datos_Usuario->Usuario.":".$datos_Usuario->Nombre." ".$datos_Usuario->Apellidos.":");
        $len = mysqli_num_rows($bloque2);
        $cont=0;
        while($referencias=mysqli_fetch_array ($bloque2)){
            if ($len!=0) {
                if ($cont == $len - 1){
                    echo $referencias['Ref_Bancaria'];
                }
                else{  
                    echo $referencias['Ref_Bancaria'].":";        
                } 
            }
            $cont++;
    }
    echo "\n";
    }
}
}
 ?> 