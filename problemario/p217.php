<?php
if(true){
  $ubicacion = trim(fgets(STDIN));
  $usuario = trim(fgets(STDIN));
  $password = trim(fgets(STDIN));
  $dataBase = trim(fgets(STDIN));

  $connection = mysqli_connect($ubicacion,$usuario,$password,$dataBase);
  $query = "SELECT us.Apellidos, us.Nombre, sum(jue.puntos) AS puntos FROM Usuarios us INNER JOIN BD_Domino_Juegos jue ON  jue.id_usuario = us.Usuario WHERE jue.id_estatus = 1 GROUP BY jue.ganador ORDER BY sum(jue.puntos) DESC LIMIT 1";
}
  if(true){
  if($connection){
    $consulta = mysqli_query($connection,$query);
if(true){
    if(mysqli_num_rows($consulta) > 0){
      while($fila = mysqli_fetch_assoc($consulta)){
        echo "$fila[Nombre] $fila[Apellidos] $fila[puntos]";
      }
    }
  }
  }
}
?>