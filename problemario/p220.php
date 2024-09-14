<?php
//   $ubicacion = trim(fgets(STDIN));
//   $usuario = trim(fgets(STDIN));
//   $password = trim(fgets(STDIN));
//   $dataBase = trim(fgets(STDIN));
  $conn=mysqli_connect("localhost", "noticias", '1234','pagoservicios'); 
  //$conn = mysqli_connect($ubicacion,$usuario,$password,$dataBase);

if ($conn) {
	$totalQuery = "SELECT CONCAT('Total de Adeudos: $', FORMAT(SUM(Monto), 2)) AS total
					FROM BD_PagoServ_Facturas
					WHERE fecha_Vencimiento <= '2019-01-20'
					AND id_FormaPago = (SELECT BD_PagoServ_Tipo_Pago.id
											FROM BD_PagoServ_Tipo_Pago
											WHERE Nombre = 'Pendiente');";
	$usersQuery = "SELECT id_Cliente,
						CONCAT('Cliente: ', U.Nombre, ' ', U.Apellidos, ' Total de Adeudo: $', FORMAT(SUM(Monto), 2)) AS mensaje
					FROM BD_PagoServ_Facturas F JOIN Usuarios U ON F.id_Cliente = U.Usuario
					WHERE fecha_Vencimiento <= '2019-01-20'
					AND id_FormaPago = (SELECT BD_PagoServ_Tipo_Pago.id
											FROM BD_PagoServ_Tipo_Pago
											WHERE Nombre = 'Pendiente')
					GROUP BY id_Cliente;";

	$total = mysqli_fetch_assoc(mysqli_query($conn, $totalQuery));
	fwrite(STDOUT, utf8_encode($total['total']) . PHP_EOL);

	$users = mysqli_fetch_all(mysqli_query($conn, $usersQuery), MYSQLI_ASSOC);

	foreach ($users as $user) {
		fwrite(STDOUT, $user['mensaje'] . PHP_EOL);
		$sql = "SELECT CONCAT('Servicio: ', S.Nombre, ' Total: $', FORMAT(SUM(Monto), 2), ' Fecha Venc.: ',
							F.fecha_Vencimiento) AS mensaje
					FROM BD_PagoServ_Facturas F JOIN BD_PagoServ_Servicios S ON F.id_Servicio = S.id
					WHERE F.id_Cliente = '" . $user['id_Cliente'] ."'
					AND fecha_Vencimiento <= '2019-01-20'
					AND id_FormaPago = (SELECT BD_PagoServ_Tipo_Pago.id
											FROM BD_PagoServ_Tipo_Pago
											WHERE Nombre = 'Pendiente')
					GROUP BY F.id_Servicio
					ORDER BY F.fecha_Vencimiento ASC;";
		$debts = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);

		foreach ($debts as $debt)
			fwrite(STDOUT, utf8_encode($debt['mensaje']) . PHP_EOL);
	}
}
?>