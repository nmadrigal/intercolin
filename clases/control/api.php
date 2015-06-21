<?PHP
 ob_start();
	include("config.php");
	$idAnuncio = $_POST["idAnuncio"];
 
	require_once($conf["pathgui"]."GUIIntercolin.php");
	$objGui=new GUIIntercolin($conf);
	require_once($conf["pathmodelo"]."Intercolin.php");
	$obj= new Intercolin($conf);		

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
		  	
	}
?>