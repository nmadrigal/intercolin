<?PHP
 ob_start();
  $conf["pathgui"]="clases/vista/";
  $conf["pathmodelo"]="clases/modelo/";
  $conf["pathcontrol"]="clases/control/";
  $conf["pathdb"]="include/db/";
  $conf["images"]="Content/Images/";
  $conf["uploads"]= "uploads/";

               include("clases/modelo/DBMysql.php");
               include("include/db/db.php");


 function conect($db,$host,$user,$pass){

    $this->idConexion=mysql_connect($host,$user,$pass);
    if(!$this->idConexion){
	$this->errorText="No hay conexion al servidor/maquina";
	$this->errorNum=mysql_errno();
	return 0;
    }
    if(!mysql_select_db($db,$this->idConexion)){
	$this->errorText="No es posible abrir DB:".$db;
	$this->errorNum=mysql_errno();
	return 0;
    }
    //Si todo salio bien, regresamos el identificador de la conexion;
    return $this->idConexion;
  }
	if(isset($_GET['op']))
		$op = $_GET['op'];
	if(isset($_POST['op']))
		$op = $_POST['op'];

 $db = conect($db,$host,$user,$pass);
  echo $db;
	switch($op){
		case "allventa";
                        $tipoInmueble =  $_POST["tipoInmueble"];
                        //$inmuebles = $obj->getVentaTIpoInmueble($tipoInmueble);
			//echo $tipoInmueble;
	        break;

	}
?>