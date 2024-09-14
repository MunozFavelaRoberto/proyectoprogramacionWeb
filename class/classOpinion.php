<?php
include "ClassBD.php";

class Opinion extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";
		switch ($accion) {
            case 'censurar':
				$this->consulta("UPDATE Opinion set Censurado=if(Censurado='1','','1') where IdOpinion=".$_POST['Id']);
                $resultado=$this->procesa("list");
				break;
            case 'detalle':
				$resultado= '<div class="container">
                <div class="row">';
                $registro=$this->obtenRegistro("SELECT Comentario, O.Fecha, concat (nombre,' ',apellidos,'<br><small class=\"badge bg-secondary\">',Email,'</small>') User, Titulo from Opinion O join Usuario U on O.IdUsuario=U.IdUsuario join Noticia N on N.IdNoticia=O.IdNoticia where O.IdOpinion=".$_POST['Id']);
                $resultado.='<div class="col-1">'.$registro->Fecha.'</div>'.'<div class="col-4">'.$registro->User.
                '</div><div class="col-3">'.$registro->Comentario.'</div><div class="col-4">'.$registro->Titulo.
                '</div">';
                $resultado.='</div>
                </div>';
				break;
			case 'delete':
				$this->consulta("DELETE from opinion WHERE IdPais=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into opinion set Nombre ='".$_POST['Pais']."'");
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'list':
				$tmp = $this->obteArreglo("SELECT * FROM opinion order by Fecha;");
				$resultado.='
				<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Opinion</span>
						</div>
					</div>
					<div class="row">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
                                if($registro['Censurado']=="")
								$resultado .='<td class="col-md-1">'.$this->crearIcono("censurar",$registro['IdOpinion'],"nocensurado.png").'<td>';
                                else $resultado .='<td class="col-md-1">'.$this->crearIcono("censurar",$registro['IdOpinion'],"censurado.png").'<td>';
                                
                                $resultado .='<td class="col-md-1">'.$this->crearIcono("detalle",$registro['IdOpinion'],"detalle.png").'<td>';
								$resultado .='<td class="col-md-10">'.$registro['Comentario'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'formEdit':
				$registro = $this->obtenRegistro("SELECT * FROM opinion where IdPais = ".$_POST['Id']);
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
								.(($accion == 'nuevo')?"Nuevo":"Actualizar").' Opinion
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Opinion</label>
									<div class="col-sm-10">
										<input type="Opinion" name="Opinion" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
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
				$this->consulta("UPDATE opinion set Nombre ='".$_POST['Pais']."' WHERE IdPais = ".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classOpinion";
		}
		return $resultado;
	}
	function crearIcono($acc,$reg,$imag)
	{
		$html='<form method="post">
		<input type="hidden" name="accion" value="'.$acc.'" />
		<input type="hidden" name="Id" value="'.$reg.'" />
		<input type="image" class="icono" src="../images/'.$imag.'" />
		</form>';
		return $html;
	}
}

$oOpinion = new Opinion(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>