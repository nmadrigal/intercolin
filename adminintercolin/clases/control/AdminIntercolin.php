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
		
		case "adminanuncios";
				$this->objGui->showAdminAnuncios();
				
			break;
		
		//not working
		case "agregaranuncio";
				$ban = $_GET["ban"];
				if($ban == 0){
					$tipoInmuebles = $this->obj->getTipoInmuebles();
					$this->objGui->showAgregarAnuncio($tipoInmuebles);
				}
				if($ban == 1){
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
					$id = $this->obj->addAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosTerreno, $metrosConst, $numCuartos, $numPlantas );	
					//return $id;					
				}
				
			break;
			
		case "validarimagen";
				 // $file = $_POST["file"];
				 // echo $file;
				 $ds          = DIRECTORY_SEPARATOR;  //1
				 $storeFolder = '..\..\Content\Images\Casas\Venta';   //2		
				
				 if (!empty($_FILES)) {						
				 //if (file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){
					 $tempFile = $_FILES['file']['tmp_name'];          //3             					  
					 $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4					 
					 $targetFile =  $targetPath. $_FILES['file']['name'];  //5				 
					 move_uploaded_file($tempFile,$targetFile); //6					 
				 }
				
			break;
			
		case "adminventa";							
				$ventaInmueble = $this->obj->getVentaInmueble();
				if($ventaInmueble)
					$this->objGui->showGetAdminVenta($ventaInmueble);
				
			break;
			
		case "editaranuncio";
			$ban = $_GET["ban"];
			$idAnuncio = $_GET["id"];				
			if($ban == 0){
				$tipoInmuebles = $this->obj->getTipoInmuebles();
				$detalles = $this->obj->getDetalleAnuncio($idAnuncio);
				$this->objGui->showDetalleAnuncio($detalles, $tipoInmuebles);
			}
			if($ban == 1)
			{
				$idAnuncio = $_GET["id"];
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
				$this->obj->editarAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosTerreno, $metrosConst, $numCuartos, $numPlantas, $idAnuncio );											
				
			}								
			
		break;
			
		case "eliminaranuncio";
				
				$idAnuncio = $_POST["idAnuncio"];
				$this->obj->eliminarAnuncio($idAnuncio);
				//return $i;
				
			break;	
			
		case "servicios";
				$this->objGui->showServicios();
			break;
			
		case "getGas";	// agregar gasto
				$b=$_GET["b"];
				if($b==0)
				  $this->objGui->showGetGastos();
				if($b==1)
				   { 
				    $concept=$_POST["concept"];
				    $tot=$_POST["tot"];
				    $dia=$_POST["dia"];
				    $mes=$_POST["mes"];
				    $ano=$_POST["ano"];
				    $this->obj->addGas($concept,$tot,$dia,$mes,$ano);				   
				    ?>
       	  			      <script>
	    			      confirmAdd();
          			      </script>
              			    <?PHP
				   }
				  
			break;


		case "getVent"; 
				$b=$_GET["b"];
				if($b==0)
				  $this->objGui->showGetVentas();
				if($b==1)
				   {
				    $tot=$_POST["tot"];
				    $tipo=$_POST["tipoVenta"];
				    $dia=$_POST["dia"];
				    $mes=$_POST["mes"];
				    $ano=$_POST["ano"];				  				    				    
				    $this->obj->addVent($tot,$tipo,$dia,$mes,$ano);
				    ?>
       	  			      <script language="javascript">
	    			      confirmAdd();
          			      </script>
              			    <?PHP
				   }
			break;		
		

		case "menuCons";
				$this->objGui->showMenuCons();
			break;


		case "cComp";
				$b=$_GET["b"];
				if($b==0)
				  $this->objGui->showConsComp();

				if($b==1)
				   {
				      $tipoCom=$_POST["tipoCom"];
				      $tipoCCom=$_POST["tipoCCom"];					
				      $dia=$_POST["cDia"];
				      $mes=$_POST["cMes"];	
				      $ano=$_POST["cAno"];
					
				      $compras=$this->obj->getComp($tipoCom,$tipoCCom,$dia,$mes,$ano);
				      $this->objGui->showConsC($compras);
				   }
			break;
				
		case "cGas";
				$b=$_GET["b"];
				if($b==0)
				  $this->objGui->showConsGas();
				if($b==1)
				   {
				      $tipo=$_POST["tipoCGas"];
				      $dia=$_POST["cDia"];
				      $mes=$_POST["cMes"];	
				      $ano=$_POST["cAno"];
				      
				      $gastos=$this->obj->getGas($tipo,$dia,$mes,$ano);
				      $this->objGui->showConsG($gastos);
				   }
			break;


		case "cVent";
				$b=$_GET["b"];
				if($b==0)
				 $this->objGui->showConsVent();
				if($b==1)
				   {
				      $tipoVen=$_POST["tipoVen"];
				      $tipoCVen=$_POST["tipoCVen"];					
				      $dia=$_POST["cDia"];
				      $mes=$_POST["cMes"];	
				      $ano=$_POST["cAno"];					
				      $ventas=$this->obj->getVent($tipoVen,$tipoCVen,$dia,$mes,$ano);
				      $this->objGui->showConsV($ventas,$tipoVen,$tipoCVen);
				   }
			break;


		case "delCom";
				$idCom=$_GET["idCom"];
				$this->obj->delCom($idCom);
				?>
       	  			      <script language="javascript">
	    			      confirmDel();
          			      </script>
              			<?PHP
				
			break;


		case "delGas";
				$idGas=$_GET["idGas"];
				$this->obj->delGas($idGas);
				?>
       	  			      <script language="javascript">
	    			      confirmDel();
          			      </script>
              			<?PHP
				
			break;


		case "delVen";
				$idVen=$_GET["idVen"];
				$this->obj->delVen($idVen);
				?>
       	  			      <script language="javascript">
	    			      confirmDel();
          			      </script>
              			<?PHP
				
			break;


		case "consAll"; 
				$cCont=$this->obj->getCCont();
				$cCred=$this->obj->getCCred();
				$gas=$this->obj->getGas();
				$vGen=$this->obj->getVGen();
				$vMed=$this->obj->getVMed();
				$vPat=$this->obj->getVPat();
				$vReg=$this->obj->getVReg();
				$vTar=$this->obj->getVTar();
				$this->objGui->showAll($cCont,$cCred,$gas,$vGen,$vMed,$vPat,$vReg,$vTar);
			break;


	  } //switch
	} //function
  }  //clase

?>