<?PHP
 ob_start();
	include("config.php");

	        //require_once($conf["pathgui"]."GUIIntercolin.php");
		//$this->objGui=new GUIIntercolin($conf);
		//require_once($conf["pathgui"].Intercolin.php");
		//$this->obj= new Intercolin($conf);
		//$this->conf=$conf;

	$op = $_POST["op"];
        $tipoInmueble = $_POST["tipoInmueble"];

	//$del = $obj->eliminarAnuncio($idAnuncio);
	echo $conf["pathgui"]."GUIIntercolin.php";

?>