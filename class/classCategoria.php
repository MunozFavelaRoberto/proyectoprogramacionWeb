<?php
include "ClassBD.php";

class Categoria extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";
		switch ($accion) {
			case 'delete':
				$this->consulta("DELETE from categoria WHERE IdCategoria=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into categoria set Nombre ='".$_POST['Categoria']."'");
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'list':
				$tmp = $this->obteArreglo("SELECT * FROM categoria order by Nombre;");
				$resultado.='
				<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Categoria</span>
							<a class="btn btn-sm btn-secondary" href="categoria.php?accion=nuevo"> AGREGAR <img src="../images/agregar.png" /> </a>
						</div>
					</div>
					<div class="row">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("delete",$registro['IdCategoria'],"borrar.png").'<td>';
								$resultado .='<td class="col-md-1">'.$this->crearIcono("formEdit",$registro['IdCategoria'],"editar.png").'<td>';
								$resultado .='<td class="col-md-10">'.$registro['Nombre'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'formEdit':
				$registro = $this->obtenRegistro("SELECT * FROM categoria where IdCategoria = ".$_POST['Id']);
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
								.(($accion == 'nuevo')?"Nueva":"Actualizar").' Categoria
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Categoria</label>
									<div class="col-sm-10">
										<input type="Categoria" name="Categoria" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
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
				$this->consulta("UPDATE categoria set Nombre ='".$_POST['Categoria']."' WHERE IdCategoria = ".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classCategoria";
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

$oCategoria = new Categoria(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>