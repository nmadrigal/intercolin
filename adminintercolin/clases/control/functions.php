<?PHP
 ob_start();
	include("config.php");
	//$idAnuncio = $_POST["idAnuncio"];
 
	require_once($conf["pathgui"]."GUIIntercolin.php");
	$objGui=new GUIIntercolin($conf);
	require_once($conf["pathmodelo"]."Intercolin.php");
	$obj= new Intercolin($conf);		

	if(isset($_GET["op"]))
		$op = $_GET["op"];
	elseif(isset($_POST["op"]))
		$op = $_POST["op"];
		
	switch($op){
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
			if(isset($_POST["construccion"]))
				$metrosTerreno = $_POST["construccion"];
			if(isset($_POST["terreno"]))
				$metrosConst = $_POST["terreno"];
			if(isset($_POST["descripcion"]))	
				$descripcion = $_POST["descripcion"];
			$id = $obj->addAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosTerreno, $metrosConst, $numCuartos, $numPlantas );	
			echo $id;			
			  
		break;	  
	}
	
?>