<?php
    session_start();
    if(!isset($_SESSION['Nombre']))
    {
        header("location: ../index.php?m=200");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">
    </head>
    <body>
<?php include "menu.php";
include "../class/classNoticia.php";
?>
</body>
</html>