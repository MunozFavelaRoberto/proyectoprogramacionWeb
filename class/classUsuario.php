<?php
include "ClassBD.php";

class Usuario extends BaseDatos{
	function __construct($accion)
	{
		echo $this->procesa($accion);
	}

	function procesa($accion)
	{
		$resultado ="";

		switch ($accion) {
            case 'editPerfil':
                    $registro=$this->obtenRegistro("SELECT * FROM usuario where IdUsuario=".$_SESSION['IdUser']);
                $resultado.='<div class="container">
                <form method="post" action="" enctype="multipart/form-data">';

                $resultado.='<input type="hidden" name= "accion" value="update" />
                            <input type="hidden" name="IdUser" value="'.$_SESSION['IdUser'].'" />';
    
                $resultado.='
            <fieldset>
                <div class="col-6 rounded-3 mt-4"
                style="border-style: solid !important;padding:15px;">
                <legend>Editar perfil</legend>

                <div class="form-group row rounded-3 mt-2">
                    <label class="col-sm-2 col-form-label">Nombre *</label>
                    <div class="col-sm-10">
                    <input type="Nombre" name="Nombre" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
                    </div>
                </div>
                                    <div class="form-group row rounded-3 mt-2">
                                        <label class="col-sm-2 col-form-label">Apellidos *</label>
                                        <div class="col-sm-10">
                                            <input type="Apellidos" name="Apellidos" required="" class="form-control" value="'.(isset($registro->Apellidos)?$registro->Apellidos:"").'" />
                                        </div>
                                    </div>

                                   
                                    <div class="form-group row rounded-3 mt-2">
                                        <label class="col-sm-2 col-form-label">Genero *</label>
                                        <div class="col-sm-10">
                                        <div class="row">
                                        <div class="col-4"><label >Femenino <input type="radio" name="Genero" value="F"'.(($registro->Genero=='F')?" checked ":"").' /> </label></div><div class="col-4">Masculino <input type="radio" name="Genero" value="M" '.(($registro->Genero=='M')?" checked ":"").' /></div><div class="col-4">Otro <input type="radio" name="Genero" value="O" '.(($registro->Genero=='O')?" checked ":"").' /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row rounded-3 mt-2">
                                        <label class="col-sm-2 col-form-label">Password *</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="Password" required="" class="form-control" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group row rounded-3 mt-2">
                                        <label class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" accept="image/jpeg" name="foto" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row" mt-2>
                                    <div class="col-md-6"><small>* campo obligatorio</small></div>
                                    <div class="col-md-6">
                                    <button style="margin-left: 50%;" type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form></div> ';
                            break;
            case 'update':
                if ($_FILES['foto']['name']>"")
                if ($_FILES['foto']['size']<105000)
                { $FOTO="../fotos/".$_FILES['foto']['name'];
                    move_uploaded_file($_FILES['foto']['tmp_name'], $FOTO);
                    $bytes=file_get_contents($FOTO);
                    $bytes=addslashes($bytes);

                    unlink($FOTO);
                }
				$this->consulta("UPDATE usuario set Nombre='".$_POST['Nombre']."', Apellidos'".$_POST['Apellidos']."', Genero='".$_POST['Genero']."', Password=password('".$_POST['Password']."') ".
                (isset($bytes)?", Foto='".$bytes."'":"")." WHERE IdUsuario=".$_POST['IdUser']);
                $_SESSION['Nombre']=$_POST['Nombre']." ".$_POST['Apellidos'];
                if(isset($bytes))
                {   $registro=$this->obtenRegistro("SELECT Foto from Usuario where IdUsuario IdUsuario=".$_POST['IdUser']);
                    $_SESSION['Foto']=$registro->Foto;
                }
				break;

            case 'login': break;
            case 'registro': break;
            //-------------------------------------------------------
            case 'censurar':
				$this->consulta("UPDATE Opinion set Censurado=if(Censurado='1','','1') where IdUsuario=".$_POST['Id']);
                $resultado=$this->procesa("list");
				break;
            case 'detalle':
				$resultado='<div class="container">
                <div class="row">';
                $registro=$this->obtenRegistro("SELECT Comentario, O.Fecha, concat (nombre,' ',apellidos,'<br><small class=\"badge bg-secondary\">',Email,'</small>') User,Titulo from Opinion O join Usuario U on O.IdUsuario=U.IdUsuario join Noticia N on N.IdNoticia=O.IdNoticia where O.IdOpinion=".$_POST['Id']);
                $resultado.='<div class="col-1">'.$registro->Fecha.'</div>'.'<div class="col-4">'.$registro->User.
                '</div><div class="col-3">'.$registro->Comentario.'</div><div class="col-4">'.$registro->Titulo.'</div>';
                $resultado.='</div>
                </div>';
				break;
			case 'delete':
				$this->consulta("DELETE from Opinion WHERE IdPais=".$_POST['Id']);
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'insert':
				$this->consulta("INSERT into Usuario set Nombre ='".$_POST['Pais']."'");
				$resultado = $this->procesa("list");
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'list':
				$cad ="SELECT * FROM Opinion order by Fecha";
                $tmp = $this->obteArreglo($cad);
				$resultado.='<div class="container">
					<div class="row">
						<div class="col-12">
							<span class="badge bg-primary">Usuario</span>
						</div>
					</div>
					<div class="row">
                    <div class="col-md-12">
						<table class="table table-hover table-striped"';
							foreach ($tmp as $registro) {
								$resultado .='<tr>';
                                if($registro['Censurado']=="")
								$resultado .='<td class="col-md-1">'.$this->crearIcono("censurar",$registro['IdUsuario'],"nocensurado.png").'<td>';
                                else $resultado .='<td class="col-md-1">'.$this->crearIcono("censurar",$registro['IdUsuario'],"censurado.png").'<td>';
                                
                                $resultado .='<td class="col-md-1">'.$this->crearIcono("detalle",$registro['IdUsuario'],"detalle.png").'<td>';
								$resultado .='<td class="col-md-10">'.$registro['Comentario'].'</td>';
								$resultado .='</tr>';
							}
							$resultado .='</table></div> </div></div>';
				break;
			//------------------------------------------------------------------------------------------------------------------------------------------
			case 'formEdit':
				$registro = $registro=$this->obtenRegistro("SELECT * FROM Usuario where IdPais = ".$_POST['Id']);
			case 'nuevo': $resultado.='<div class="container">
					<form method="post" action="">';
						if ($accion == 'nuevo') $resultado .='<input type= "hidden" name= "accion" value= "insert" />';
						else $resultado.='<input type= "hidden" name= "accion" value= "update" />
						<input type= "hidden" name= "Id" value= "'.$_POST['Id'].'" />';

						$resultado.='
						<fieldset>
							<div class= "col-6 rounded-3 mt-4"
                            style= "border-style: solid !important;padding:15px;">
								<legend>'.(($accion == 'nuevo')?"Nuevo":"Actualizar").' Usuario</legend>
								<div class="form-group row rounded-3">
									<label class="col-sm-2 col-form-label">Usuario</label>
									<div class="col-sm-10">
										<input type="Usuario" name="Usuario" required="" class="form-control" value="'.(isset($registro->Nombre)?$registro->Nombre:"").'" />
									</div>
								</div>
								<div style="">
								<button style="margin-left: 50%;" type="submit" class="btn btn-primary">'.(($accion=='nuevo')?"Agregar":"Actualizar").'</button>
								</div>
							</div>
						</fieldset>
        			</form></div> ';
				break;
			
			//------------------------------------------------------------------------------------------------------------------------------------------
			default: $resultado = "La accion '".$accion."', no esta programada en classUsuario";
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

$oUsuario = new Usuario(isset($_REQUEST['accion'])?$_REQUEST['accion']:'list');
?>