<?php
include "ClassBD.php";

class Noticia extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";
		switch ($accion) {
            case 'Aprobar':
				$this->consulta("UPDATE Noticia set IdEditor=if(IdEditor=0,".$_SESSION['IdUser'].",0) where IdNoticia=".$_POST['Id']);
                $resultado=$this->procesa("list");
				break;
            case 'detalle':
				$resultado= '<div class="container">
                <div class="row">';
                $registro=$this->obtenRegistro("SELECT Fecha,Titulo,Descripcion, concat(Nombre,' ',Apellidos,'<br><small class=\"badge bg-primary\">',Email,'</small>')User from Noticia N join Usuario U on U.IdUsuario=N.IdReportero where IdNoticia=".$_POST['Id']);
                $resultado.='<div class="container">
				<div class="row">
				<div class="col-12">
				<span class="badge bg-primary">Detalle
				</span>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
				<table class="table table-hover table-striped"';

				$resultado.='<tr>';
				$resultado.='<td class="col-md-3">'.$registro->Fecha.'</td>';
				$resultado.='<td class="col-md-3">'.$registro->Titulo.'</td>';
				$resultado.='<td class="col-md-3">'.$registro->Descripcion.'</td>';
				$resultado.='<td class="col-md-3">'.$registro->User.'</td>';
				
				$resultado.='</tr>';
				break;
	/*		case 'delete':
				$this->consulta("DELETE from Noticia WHERE IdPais=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into Noticia set Nombre ='".$_POST['Pais']."'");
				$resultado = $this->procesa("list");
				break;*/
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$cad="INSERT into Noticia set ";

				foreach($_POST as $nombre => $valor){
					if($nombre!='accion')
					$cad.= $nombre."='".$valor."',";
				}
				//$cad=substr($cad,0,-1);
				$cad.='IdReportero='.$_SESSION['IdUser'].", Fecha='".date("Y-m-d H:i:s")."';";
				$this->consulta($cad);
				$resultado = $this->mensError.$this->procesa("list");
				break;
			//---------------------formNew------------------------
			case 'formNew':
				$resultado.=
				'<div class="container">
					<form method="POST" action="">';
						if ($accion == 'formNew') {
							$resultado .='<input type= "hidden" name= "accion" value= "insert" />';
						}
						else
							$resultado .='<input type= "hidden" name= "accion" value= "update" />
						<input type= "hidden" name= "Id" value= "'.$_POST['Id'].'" />';

						$resultado .='
						<fieldset>
							<div class= "col-6 rounded-3 mt-4" style= "border-style: solid !important;padding:15px;">
								<legend>'
								.(($accion == 'formNew')?"Nueva":"Actualizar").' Noticia
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Titulo</label>
									<div class="col-sm-10">
										<input type="Titulo" name="Titulo" required="" class="form-control" value="'.(isset($registro->Titulo)?$registro->Titulo:"").'" />
									</div>
								</div>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Descripcion</label>
									<div class="col-sm-10">
										<textarea name="Descripcion" required="" class="form-control">'.(isset($registro->Descripcion)?$registro->Descripcion:"").'</textarea>
									</div>
								</div>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Pais</label>
									<div class="col-sm-10">'.$this->creaSelect("SELECT * FROM Pais order by Nombre","IdPais","IdPais","Nombre").'
									</div>
								</div>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Categoria</label>
									<div class="col-sm-10">'.$this->creaSelect("SELECT * FROM Categoria order by Nombre","IdCategoria","IdCategoria","Nombre").'
									</div>
								</div>
								<div style="">
								<button style="margin-left: 50%;" type="submit" class="btn btn-primary">'
								.(($accion=='formNew')?"Agregar":"Actualizar").'</button>
								</div>
							</div>
						</fieldset>
        			</form>
   				</div>';
				break;
			//---------------------------------------------
			case 'list':
				if ($_SESSION['tipoUser']==1 || $_SESSION['tipoUser']==3)
					$cad="SELECT IdNoticia,Fecha,concat(Titulo,'<br><span class=\"badge bg-secondary\">',Nombre,' ',Apellidos,'</span>') Noticia, IdEditor FROM Noticia N join Usuario U on U.IdUsuario=N.IdReportero order by Fecha";
				else
					$cad="SELECT IdNoticia,Fecha,concat(Titulo,'<br><span class=\"badge bg-secondary\">Views: ',Visitas,' likes: ',Likes,'</span>',' <span class=\"badge bg-info\">',Fecha,'</span>') Noticia, IdEditor FROM Noticia N join Usuario U on U.IdUsuario=N.IdReportero where IdReportero=" .$_SESSION['IdUser']." order by Fecha";
				
				$tmp=$this->obteArreglo($cad);
				$resultado.='
				<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Noticias </span>'.(($_SESSION['tipoUser']==2)?$this->crearIcono("formNew",0,"agregar.png"):"").'
						</div>
					</div>
					<div class="row">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
								if($_SESSION['tipoUser']==1) //iconos del administrador
								{	if($registro['IdEditor'])
										$resultado .='<td class="col-md-1">'.$this->crearIcono("Aprobar",$registro['IdNoticia'],"nocensurado.png").'<td>';
									else $resultado .='<td class="col-md-1">'.$this->crearIcono("Aprobar",$registro['IdNoticia'],"censurado.png").'<td>';

									$resultado .='<td class="col-md-1">'.$this->crearIcono("detalle",$registro['IdNoticia'],"detalle.png").'<td>';
									$resultado .='<td>'.$registro['Fecha'].'</td>';
								}
								elseif($_SESSION['tipoUser']==2)
								{
									$resultado .='<td class="col-md-1">'.$this->crearIcono("delete",$registro['IdNoticia'],"borrar.png").'<td>';
									$resultado .='<td class="col-md-1">'.$this->crearIcono("formEdit",$registro['IdNoticia'],"editar.png").'<td>';
									$resultado .='<td class="col-md-1">'.$this->crearIcono("agreRef",$registro['IdNoticia'],"aniadirref.png").'<td>';
									$resultado .='<td class="col-md-1">'.$this->crearIcono("agreImag",$registro['IdNoticia'],"subimage.png").'<td>';
								}
								else; //usuario normal;

								
								$resultado .='<td>'.$registro['Noticia'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
	/*		case 'formEdit':
				$registro = $this->obtenRegistro("SELECT * FROM Noticia where IdPais = ".$_POST['Id']);
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
								.(($accion == 'nuevo')?"Nuevo":"Actualizar").' Noticia
								</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Noticia</label>
									<div class="col-sm-10">
										<input type="Noticia" name="Noticia" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
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
				$this->consulta("UPDATE Noticia set Nombre ='".$_POST['Pais']."' WHERE IdPais = ".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;*/
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classNoticia";
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

$oNoticia = new Noticia(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>