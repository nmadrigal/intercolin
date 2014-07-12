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
	//example  insert
	//INSERT INTO `venta_inmueble` 
	//(`id`, `titulo`, `descripcion`, `precio`, `moneda_precio`, `zona`, `colonia`, `tipo_inmueble`, `metros_terreno`, `metros_construccion`, `url_image`) VALUES (NULL, '', 'se vende casa muy bonita en la colonia del valle', '1,500000', 'pesos', 'Benito Ju�rez', 'Del Valle', 'casa', '150', '120', '');
	
	function getVentaInmueble(){
	$sql = "SELECT id, titulo, descripcion, precio, moneda_precio, estado, zona, colonia, tipo_inmueble, metros_terreno, metros_construccion, num_cuartos, num_banos, num_plantas, amueblado, url_image, DATE_FORMAT( fecha_publicacion,  '%d-%m-%Y' ) AS fecha_publicacion FROM venta_inmueble ORDER BY fecha_publicacion DESC";
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