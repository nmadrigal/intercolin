<?PHP
 ob_start();
  class AdminIntercolin{
	var $objGui;
	var $obj;
	var $conf;

	function AdminIntercolin($conf){
		require_once($conf["pathgui"]."GUIIntercolin.php");
		$this->objGui=new GUIIntercolin($conf);
		require_once($conf["pathmodelo"]."Intercolin.php");
		$this->obj= new Intercolin($conf);
		$this->conf=$conf;
	}

	function controlador($op){

	  switch($op){
		case "index";
				$this->objGui->showIndex();
			break;
		
		// case "venta";
				// $this->objGui->showVenta();
				
			// break;

		case "servicios";
				$this->objGui->showServicios();
			break;
			
		case "venta";				
				$ventaInmueble = $this->obj->getVentaInmueble();
				if($ventaInmueble)
					$this->objGui->showGetVenta($ventaInmueble);
				
			break;
			
		case "detalleanuncio";
				$idAnuncio=$_GET["id"];
				$detalles = $this->obj->getDetalleAnuncio($idAnuncio);
				$this->objGui->showDetalleAnuncio($detalles);
				
			break;
		
		case "contacto";
			$ban = $_GET["ban"];
			if($ban == 0)			
				$this->objGui->showContacto();				
			if($ban == 1)
			{
				$nombre = $_POST["nombre"];
				$apellido = $_POST["apellido"];
				$email = $_POST["email"];
				$tel = $_POST["tel"];
				$subj = $_POST["subj"];
				$mensaje = $_POST["mensaje"];
				$this->obj->sendEmail($nombre,$apellido,$email,$tel,$subj,$mensaje);
				echo "<script>alert('Gracias por sus comentarios, nos pondremos en contacto con ud. a la brevedad');</script>";
				echo "<script> window.location.href = 'index.php?mod=home&op=contacto&band=0'; </script>";
			}
							
			break;
			

	  } //switch
	} //function
  }  //clase

?>