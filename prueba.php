<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
</head>
<body>
    <form method="post">
        <input type="" name="Renglones" placeholder="Renglones">
        <input type="" name="Columnas" placeholder="Columnas">
        <select name="Color">
            <option>Ninguno</option>
            <option><span class="text-danger">table-danger</span></option>
            <option><span class="text-success">table-success</span></option>
            <option><span class="text-warning">table-warning</span></option>
            <option><span class="text-secondary">table-secondary</span></option>
            <option><span class="text-info">table-info</span></option>
</select>
<input type="submit" name="">
    </form>
    <?php 
    if(isset($_POST['Renglones']))
        if($_POST['Color']=="Ninguno")
    echo f_imprTabla($_POST['Renglones'],$_POST['Columnas']);
    else echo f_imprTabla($_POST['Renglones'],$_POST['Columnas'],$_POST['Color']);

    function f_imprTabla($pR,$pC,$pColor="table-info") //parametros
    {
        $result='<table class="table table-striped '.$pColor.' table-hover" >';
        for($r=0; $r<$pR; $r++)
        {   $result.='<tr>';
            for($c=0; $c<$pC; $c++)
            $result.='<td>'.$r.','.$c.'</td>';
            $result.='</tr>';
        }
        $result.='</table>';
        return $result;
    }


    function suma($dato1,$dato2)//parametros por valor (A no afecta a dato1 y viseversa)
    {
        $dato1++;
        return $dato1+$dato2;
    }
    $A=45; $B=67;
    $C=suma($A,$B);
    echo $A;//imprimiria el 45


    function suma(&$dato1,$dato2)//parametros por referencia (A si afecta a dato1 y viseversa. dato1 es el podo de A por el &)
    {
        $dato1++; //45+1 = 46
        return $dato1+$dato2;
    }
    $A=45; $B=67;
    $C=suma($A,$B);
    echo $A; //imprimiria el 46
    ?>
</body>
</html>