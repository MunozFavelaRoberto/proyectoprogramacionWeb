<?php
fscanf(STDIN, "%s", $s);
fscanf(STDIN, "%s", $u);
fscanf(STDIN, "%s", $p);
fscanf(STDIN, "%s", $d);

$conn = mysqli_connect($s, $u, $p, $d);

if ($conn)
{
    $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = '$d' ORDER BY 1 DESC";

    $tables = mysqli_fetch_all(mysqli_query($conn, $query), MYSQLI_NUM);

    $res = "";
    foreach ($tables as $table)
        $res .= $table[0].":";

    fwrite(STDOUT, substr($res, 0, strlen($res) - 1) . PHP_EOL);
}
?>