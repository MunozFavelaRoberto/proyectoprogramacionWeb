<?php
    session_start();
    if(!isset($_SESSION['Nombre']))
    {
        header("location: ../index.php?m=200");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <link rel="stylesheet" href="../CSS/bootstrap.css">
        <link rel="stylesheet" href="../CSS/estilos.css?v=1.0">
    </head>
    <body>
<?php include "menu.php"; ?>
<?php include "../class/classOpinion.php"; ?>
</body>
</html>