<?php
include "ClassBD.php";

class Pais extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";
		switch ($accion) {
			case 'delete':
				$this->consulta("DELETE from pais WHERE IdPais=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into Pais set Nombre ='".$_POST['Pais']."'");
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'list':
				$tmp = $this->obteArreglo("SELECT * FROM pais order by Nombre;");
				$resultado.='
				<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Pais</span>
							<a class="btn btn-sm btn-secondary" href="pais.php?accion=nuevo"> AGREGAR <img src="../images/agregar.png" /> </a>
						</div>
					</div>
					<div class="row">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("delete",$registro['IdPais'],"borrar.png","onclick=\"return confirm('Estas Segur@ de borrar ".$registro['Nombre']." ?')\"  ").'<td>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("formEdit",$registro['IdPais'],"editar.png").'<td>';
								$resultado .='<td class="col-md-10">'.$registro['Nombre'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'formEdit':
				$registro = $this->obtenRegistro("SELECT * FROM Pais where IdPais = ".$_POST['Id']);
			case 'nuevo':
				$resultado.=
				'<div class="container">
					<form method="POST" action="">';
						if ($accion == 'nuevo') {
							$resultado .='<input type= "hidden" name= "accion" value= "insert" />';
						}
						else
							$resultado .='<input type= "hidden" name= "accion" value= "update" />
						<input type= "hidden" name= "Id" value= "'.$_POST['Id'].'" />';

						$resultado .='
						<fieldset>
							<div class= "col-6 rounded-3 mt-4" style= "border-style: solid !important;padding:15px;">
								<legend>'
								.(($accion == 'nuevo')?"Nuevo":"Actualizar").' Pais
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Pais</label>
									<div class="col-sm-10">
										<input type="Pais" name="Pais" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
									</div>
								</div>
								<div style="">
								<button style="margin-left: 50%;" type="submit" class="btn btn-primary">'
								.(($accion=='nuevo')?"Agregar":"Actualizar").'</button>
								</div>
							</div>
						</fieldset>
        			</form>
   				</div>';
				break;
			case 'update':
				$this->consulta("UPDATE pais set Nombre ='".$_POST['Pais']."' WHERE IdPais = ".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classPais";
		}
		return $resultado;
	}
	function crearIcono($acc,$reg,$imag,$conf="")
	{
		$html='<form method="post">
		<input type="hidden" name="accion" value="'.$acc.'" />
		<input type="hidden" name="Id" value="'.$reg.'" />
		<input type="image" src="../images/'.$imag.'" '.$conf.' />
		</form>';
		return $html;
	}
}

$oPais = new Pais(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>