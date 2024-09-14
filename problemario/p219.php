<?php
  $ubicacion = trim(fgets(STDIN));
  $usuario = trim(fgets(STDIN));
  $password = trim(fgets(STDIN));
  $dataBase = trim(fgets(STDIN));

  $connection = mysqli_connect($ubicacion,$usuario,$password,$dataBase);

  $tablaDataBase = "BD_PagoServ_Facturas";

  $getPrimaryKey = "SELECT COLUMN_NAME, COLUMN_TYPE FROM `information_schema`.`COLUMNS` WHERE (`TABLE_SCHEMA` = '$dataBase') AND (`COLUMN_KEY` = 'PRI') AND (`TABLE_NAME` = '$tablaDataBase')";

  $getForeignKeys = "SELECT kcu.COLUMN_NAME, kcu.REFERENCED_TABLE_NAME, kcu.REFERENCED_COLUMN_NAME, c.COLUMN_TYPE FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu INNER JOIN INFORMATION_SCHEMA.COLUMNS c ON kcu.COLUMN_NAME = c.COLUMN_NAME WHERE kcu.TABLE_SCHEMA = '$dataBase' AND kcu.TABLE_NAME = '$tablaDataBase' AND kcu.REFERENCED_TABLE_NAME IS NOT NULL ORDER BY 1 ASC";

  $consultaPrimary = mysqli_query($connection,$getPrimaryKey);

  $resultadoPrimaryKeys = array();

  if(true){
  if($fila = mysqli_fetch_array($consultaPrimary)){
    $resultadoPrimaryKeys[] = $fila;
  }
  

  foreach($resultadoPrimaryKeys as $resInd){
    echo "Nombre de llave primaria: $resInd[0] [$resInd[1]]\n";
  }
  echo "Foraneas: \n";

  $consultaForeign = mysqli_query($connection,$getForeignKeys);

  $resultadoForeignKeys = array();
  while($fila = mysqli_fetch_array($consultaForeign)){
    $resultadoForeignKeys[] = $fila;
  }

  foreach($resultadoForeignKeys as $resIndFo){
    echo "Nombre:$resIndFo[0] <=> Tabla Referenciada:$resIndFo[1] <=> CampoForaneo:$resIndFo[2] <=> [$resIndFo[3]]\n";
  }
}

?>