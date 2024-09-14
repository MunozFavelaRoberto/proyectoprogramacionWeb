
<?php 

class BaseDatos
{ var $conexion;
    var $nume_Registros;
    var $mensError;

    function conexion()
    { $this->conexion=mysqli_connect("localhost", "noticias", '1234','noticias'); 

    }
    function cierreBD(){mysqli_close($this->conexion);}
    function consulta($query)
    { $this->conexion();
        $bloque=mysqli_query($this->conexion,$query);
        if(strpos(strtoupper($query),"SELECT" )!==false ){
            $this->nume_Registros=mysqli_num_rows($bloque);
        }
        
        $this->mensError=mysqli_error($this->conexion);
        $this->cierreBD();
        return $bloque;
    }
    function obteArreglo($query){
        $bloque=$this->consulta($query);
        $datos=array();//arreglo vacio
        foreach ($bloque as $renglon){
            array_push($datos, $renglon);//comnstruimos un arreglo
        }
            return $datos; //retornamos el arreglo
    }
    function obtenRegistro($query){
        $registros=$this->consulta($query);
        return mysqli_fetch_object($registros);
    }
    function creaSelect($query,$nombCampFormulario,$valorOpcion,$infoDespegar)
    { //crea lista desplegable
        $html='<select name="'.$nombCampFormulario.'" class="form-control">';
        $opciones=$this->obteArreglo($query);
        foreach($opciones as $opcion)
            $html.='<option value="'.$opcion[$valorOpcion].'" >'.$opcion[$infoDespegar].'</option>';
        $html.='</select>';
        return $html;
    }
}
$oBD=new BaseDatos();
?>