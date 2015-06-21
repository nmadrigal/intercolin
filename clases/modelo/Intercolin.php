<?PHP
  class Intercolin{
	var $conf;
	var $objDB;

	function Intercolin($conf){
		$this->conf=$conf;
		$this->conect();		
	}
	
	function conect(){	
		require_once($this->conf["pathmodelo"]."DBMysql.php");
		include($this->conf["pathdb"]."db.php");
		$this->objDB=new DBMysql();
		$this->objDB->conect($db,$host,$user,$passwd);		

	}
	
       function getTipoInmuebles(){
		$sql = "SHOW COLUMNS FROM `venta_inmueble` LIKE 'tipo_inmueble'";
		$idcon = $this->objDB->select($sql);
		$row = mysql_fetch_array($idcon);
		if(stripos(".".$row[1],"enum(") > 0) $row[1]=str_replace("enum('","",$row[1]);
		else $row[1]=str_replace("set('","",$row[1]);
		
		$row[1]=str_replace("','","\n",$row[1]);
		$row[1]=str_replace("')","",$row[1]);
		$ar = explode("\n",$row[1]);
		for ($i=0;$i<count($ar);$i++) 
			{ 
				//$arOut[str_replace("''","'",$ar[$i])]=str_replace("''","'",$ar[$i]);	
				$tipoInmuebles[] = $ar[$i];
			}
		return $tipoInmuebles ;
	}
	
	function getVentaInmueble(){
	$sql = "SELECT id, titulo, descripcion, precio, moneda_precio, estado, zona, colonia, tipo_inmueble, metros_terreno, metros_construccion, num_cuartos, num_banos, num_plantas, amueblado, url_image, DATE_FORMAT( fecha_publicacion,  '%d-%m-%Y' ) AS fecha_publicacion FROM venta_inmueble ORDER BY DATE(fecha_publicacion) DESC";
		$idcon=$this->objDB->select($sql); 
	    while($row=$this->objDB->getRow($idcon))
		{
			$ventaInmueble[] = $row;			 
		}

		if(isset($ventaInmueble))
		    return $ventaInmueble; 
		else
			return false;
	}

        public function getVentaByType($tipoInmueble){
           $sql = "SELECT id, titulo, descripcion, precio, moneda_precio, estado, zona, colonia, tipo_inmueble, metros_terreno, metros_construccion, num_cuartos, num_banos, num_plantas, amueblado, url_image, DATE_FORMAT( fecha_publicacion,  '%d-%m-%Y' ) AS fecha_publicacion FROM venta_inmueble WHERE tipo_inmueble='$tipoInmueble' ORDER BY DATE(fecha_publicacion) DESC";

            $idcon=$this->objDB->select($sql); 
	    while($row=$this->objDB->getRow($idcon))
		{
			$ventaByType[] = $row;			 
		}

		if(isset($ventaByType))
                    return $ventaByType;
		else
			echo "No se encontraron resultados";
               //echo $tipoInmueble;

       }

	function getDetalleAnuncio($id){
		$detalleAnuncio = array();
		$sql = "SELECT  id, titulo, descripcion, precio, moneda_precio, estado, zona, colonia, tipo_inmueble, metros_terreno, metros_construccion, num_cuartos, num_banos, num_plantas, amueblado, url_image, DATE_FORMAT( fecha_publicacion,  '%d-%m-%Y' ) AS fecha_publicacion FROM venta_inmueble WHERE id='$id'";
		$idcon=$this->objDB->select($sql);
		$row=$this->objDB->getRow($idcon);				
		
		return $row;
		
	}
	
	function sendEmail($nombre,$apellido,$email,$tel,$subj,$msj){
		$for = "javier.colin@intercolin.com";
		$cc = "carlos.colin@intercolin.com";
		$cabeceras = 'From: ' .$email. "\r\n" .
		'Reply-To: '. $cc . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$mensaje = 'Mensaje de: '.$nombre. ' '.$apellido."\r\n".
		'Correo de contacto: '.$email."\r\n".
		'Teléfono de contacto: '.$tel."\r\n".$msj;		
		
		mail($for, $subj, $mensaje, $cabeceras);		
	}

  }
?>