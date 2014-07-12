<?PHP
 ob_start();
	include("config.php");
	$idAnuncio = $_POST["idAnuncio"];
 
	require_once($conf["pathgui"]."GUIIntercolin.php");
	$objGui=new GUIIntercolin($conf);
	require_once($conf["pathmodelo"]."Intercolin.php");
	$obj= new Intercolin($conf);		

	$del = $obj->eliminarAnuncio($idAnuncio);
	echo $del;
?>