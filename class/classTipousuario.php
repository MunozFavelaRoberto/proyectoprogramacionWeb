<?php
include "ClassBD.php";

class Tipousuario extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";
		switch ($accion) {
			case 'delete':
				$this->consulta("DELETE from Tipousuario WHERE Id=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into Tipousuario set Nombre ='".$_POST['Tipousuario']."'");
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'list':
				$tmp = $this->obteArreglo("SELECT * FROM Tipousuario order by Nombre;");
				$resultado.='
				<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Tipo usuario</span>
							<!--<a class="btn btn-sm btn-secondary" href="tipousuario.php?accion=nuevo"> AGREGAR <img src="../images/agregar.png" /> </a>-->
						</div>
					</div>
					<div class="row">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("delete",$registro['Id'],"borrar.png").'<td>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("formEdit",$registro['Id'],"editar.png").'<td>';
								$resultado .='<td class="col-md-10">'.$registro['Nombre'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'formEdit':
				$registro = $this->obtenRegistro("SELECT * FROM Tipousuario where Id = ".$_POST['Id']);
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
								.(($accion == 'nuevo')?"Nuevo":"Actualizar").' Tipousuario
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Tipousuario</label>
									<div class="col-sm-10">
										<input type="Tipousuario" name="Tipousuario" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
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
				$this->consulta("UPDATE Tipousuario set Nombre ='".$_POST['Tipousuario']."' WHERE Id = ".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classTipousuario";
		}
		return $resultado;
	}
	function crearIcono($acc,$reg,$imag)
	{
		$html='<form method="post">
		<input type="hidden" name="accion" value="'.$acc.'" />
		<input type="hidden" name="Id" value="'.$reg.'" />
		<input type="image" src="../images/'.$imag.'" />
		</form>';
		return $html;
	}
}

$oTipousuario = new Tipousuario(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>