<?PHP
 ob_start();

	        include("../../include/config.php");
	        require_once($conf["pathgui"]."GUIIntercolin.php");
		$this->objGui=new GUIIntercolin($conf);
		require_once("../modelo/Intercolin.php");
		$this->obj= new Intercolin($conf);
		$this->conf=$conf;

	if(isset($_GET['op']))
		$op = $_GET['op'];
	if(isset($_POST['op']))
		$op = $_POST['op'];

	switch($op){
		case "allventa";
                        $tipoInmueble =  $_POST["tipoInmueble"];
                        //$inmuebles = $obj->getVentaTIpoInmueble($tipoInmueble);
			echo $tipoInmueble;
	        break;

		case "agregarAnuncio";
			$zona = $_POST["zona"];
			$colonia = $_POST["colonia"];
			if(isset($_POST["precio"]))
				$precio = $_POST["precio"];
			if(isset($_POST["tipoInmueble"]))	
				$tipoInmueble = $_POST["tipoInmueble"];
			if(isset($_POST["numPlantas"]))
				$numPlantas = $_POST["numPlantas"];
			if(isset($_POST["numCuartos"]))
				$numCuartos = $_POST["numCuartos"];
			if(isset($_POST["terreno"]))
				$metrosTerreno = $_POST["terreno"];
			if(isset($_POST["construccion"]))
				$metrosConst = $_POST["construccion"];
			if(isset($_POST["descripcion"]))	
				$descripcion = $_POST["descripcion"];
			$id = $obj->addAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosTerreno, $metrosConst, $numCuartos, $numPlantas );	
			echo $id;			
			  
		break;	  
		
		case "editarAnuncio";
			$idAnuncio = $_POST["idAnuncio"];
			$zona = $_POST["zona"];
			$colonia = $_POST["colonia"];
			if(isset($_POST["precio"]))
				$precio = $_POST["precio"];
			if(isset($_POST["tipoInmueble"]))	
				$tipoInmueble = $_POST["tipoInmueble"];
			if(isset($_POST["numPlantas"]))
				$numPlantas = $_POST["numPlantas"];
			if(isset($_POST["numCuartos"]))
				$numCuartos = $_POST["numCuartos"];
			if(isset($_POST["construccion"]))
				$metrosConst = $_POST["construccion"];
			if(isset($_POST["terreno"]))
				$metrosTerreno = $_POST["terreno"];
			if(isset($_POST["descripcion"]))	
				$descripcion = $_POST["descripcion"];
			$result = $obj->editarAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosConst, $metrosTerreno, $numCuartos, $numPlantas, $idAnuncio );														
			echo $result;			
			  
		break;	  	
	}
?>