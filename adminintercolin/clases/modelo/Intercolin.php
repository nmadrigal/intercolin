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
	
	function addAnuncio( $descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosTerreno, $metrosConst, $numCuartos, $numPlantas, $latLng, $direccion ){
		//$mes = date("m");
		//$ano = date("y");
		$fecha = date("d/m/Y H:i:s", time());
		//$hora = date("h:i");
		//$date = DATE_FORMAT(NOW(), '%e %c %Y');	
		$sql = "INSERT INTO venta_inmueble (descripcion, precio, zona, colonia, tipo_inmueble, metros_terreno, metros_construccion, num_cuartos, num_plantas, latLng, direccion, fecha_publicacion ) values ('$descripcion', '$precio', '$zona', '$colonia', '$tipoInmueble', '$metrosTerreno', '$metrosConst', '$numCuartos', '$numPlantas', '$latLng', '$direccion', CURRENT_TIMESTAMP)";
		echo $sql;
		$this->objDB->insert($sql);
		
		return $id = mysql_insert_id();
		 
		
	}
	
	function editarAnuncio($descripcion, $precio, $zona, $colonia, $tipoInmueble, $metrosConst, $metrosTerreno, $numCuartos, $numPlantas, $idAnuncio ){
		$fecha = date("y/m/d");
		$sql = "UPDATE venta_inmueble SET descripcion='$descripcion', precio='$precio', zona='$zona', colonia='$colonia', tipo_inmueble='$tipoInmueble', metros_terreno='$metrosTerreno', metros_construccion='$metrosConst', num_cuartos='$numCuartos', num_plantas='$numPlantas', fecha_publicacion='$fecha' WHERE id='$idAnuncio' ";
		$result = $this->objDB->update($sql);
		return $result;
	}
	
	function eliminarAnuncio($idAnuncio){
		$sql = "DELETE FROM venta_inmueble WHERE id='$idAnuncio'";
		$delete = $this->objDB->delete($sql);
		return $delete;
	}
	
	function getVentaInmueble(){
		$sql = "SELECT * FROM venta_inmueble ORDER BY DATE(fecha_publicacion) DESC";
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
		$sql = "SELECT * FROM venta_inmueble WHERE id='$id'";
		$idcon=$this->objDB->select($sql);
		$row=$this->objDB->getRow($idcon);				
		
		return $row;
		
	}
	
	// function getComp($tipoCom,$tipoCCom,$dia,$mes,$ano){	
	   
	  // $compras = array();

	   // if($tipoCCom=="todo")
	    // $sql="SELECT * FROM compras WHERE tipo='$tipoCom'";

	  // if($tipoCom=="todo" && $tipoCCom=="todo")	//todo - todo
	    // $sql="SELECT * FROM compras";

	  // if($tipoCom=="todo" && $tipoCCom=="dia")	//todo - dia
	    // if($dia !=0 && $mes!=0 && $ano!=0)
	      // $sql="SELECT * FROM compras WHERE dia='$dia' AND mes='$mes' AND ano='$ano'";
	    // else
	     // $sql="SELECT * FROM compras";	
	  
	  // if($tipoCom=="todo" && $tipoCCom=="mes")	//todo - mes
	    // if($mes!=0 && $ano!=0)
	      // $sql="SELECT * FROM compras WHERE mes='$mes' AND ano='$ano'";
	    	
	  // if($tipoCom=="todo" && $tipoCCom=="ano")	//todo - a�o
	    // if($ano!=0)
	    // $sql="SELECT * FROM compras WHERE ano='$ano'";

/////compras a credito y de contado    		
	
	  // if($tipoCom=="contado" || $tipoCom=="credito")
	    // {
	      // if($tipoCCom=="dia")
		// if($dia!=0 && $mes!=0 && $ano!=0)	
	          // $sql="SELECT * FROM compras WHERE tipo='$tipoCom' AND dia='$dia' AND mes='$mes' AND ano='$ano'";
	        // else
		  // $sql="SELECT * FROM compras WHERE tipo='$tipoCom'";
	
	      // if($tipoCCom=="mes")
		// if($mes!=0 && $ano!=0)	
	          // $sql="SELECT * FROM compras WHERE tipo='$tipoCom' AND mes='$mes' AND ano='$ano'";
	   	// else
		  // $sql="SELECT * FROM compras WHERE tipo='$tipoCom'";

	      // if($tipoCCom=="ano")
		// if($ano!=0)	
	          // $sql="SELECT * FROM compras WHERE tipo='$tipoCom' AND ano='$ano'";
		// else
		  // $sql="SELECT * FROM compras WHERE tipo='$tipoCom'";
	    // }

	  // $idcon=$this->objDB->select($sql); 
	     // while($row=$this->objDB->getRow($idcon))
		// {
		  // $compras[] =$row;
		// }
              // return $compras;
	    	  
	// }

	
	// function getGas($tipo,$dia,$mes,$ano){
	  
	  // $gastos = array();

	  // if($tipo=="todo")
	    // $sql="SELECT * FROM gastos_personales";
	  
	  // if($tipo=="dia")
	    // if($dia!=0 && $mes!=0 && $ano!=0)	      	 
	      // $sql="SELECT * FROM gastos_personales WHERE dia='$dia' AND mes='$mes' AND ano='$ano'";
	    // else
	      // $sql="SELECT * FROM gastos_personales";

  	  // if($tipo=="mes")
	    // $sql="SELECT * FROM gastos_personales WHERE mes='$mes' AND ano='$ano'";

	  // if($tipo=="ano")
	    // $sql="SELECT * FROM gastos_personales WHERE ano='$ano'";

	  
	  // $idcon=$this->objDB->select($sql); 
		 // while($row=$this->objDB->getRow($idcon))
		 // {
			// $gastos[] =$row;
		 // }
         // return $gastos;

	// }


	// function getVent($tipoVen,$tipoCVen,$dia,$mes,$ano){
	 
	  // $ventas = array();	 

	  // if($tipoVen=="todo" && $tipoCVen=="todo")	//todo - todo
	     // $sql="SELECT * FROM ventas";

	  // if($tipoVen=="todo" && $tipoCVen=="dia")	//todo - dia
	    // if($dia !=0 && $mes!=0 && $ano!=0)
	      // $sql="SELECT * FROM ventas WHERE dia='$dia' AND mes='$mes' AND ano='$ano'";
	    // else
	      // $sql="SELECT * FROM ventas";
	  
	  // if($tipoVen=="todo" && $tipoCVen=="mes")	//todo - mes
	    // if($mes!=0 && $ano!=0)
	      // $sql="SELECT * FROM ventas WHERE mes='$mes' AND ano='$ano'";
	    	
	  // if($tipoVen=="todo" && $tipoCVen=="ano")	//todo - a�o
	    // if($ano!=0)
	      // $sql="SELECT * FROM ventas WHERE ano='$ano'";

// ///////tipo de ventas/////

	  // if($tipoVen=="generico" || $tipoVen=="medicamento/varios" || $tipoVen=="patente" || $tipoVen=="NR" || $tipoVen=="tarjetas" || $tipoVen=="total_de_venta")
	    // {
	      // if($tipoCVen=="todo")
		// $sql="SELECT * FROM ventas WHERE tipo='$tipoVen'";
 	     
  	      // if($tipoCVen=="dia")	//dia
		// if($dia!=0 && $mes!=0 && $ano!=0)
	          // $sql="SELECT * FROM ventas WHERE tipo='$tipoVen' AND dia='$dia' AND mes='$mes' AND ano='$ano'";
		// else
	  	  // $sql="SELECT * FROM ventas WHERE tipo='$tipoVen'";

	      // if($tipoCVen=="mes")	//mes
		// if($mes!=0 && $ano!=0)	
	          // $sql="SELECT * FROM ventas WHERE tipo='$tipoVen' AND mes='$mes' AND ano='$ano'";
	      // //else
	   	// // $sql="SELECT * FROM ventas WHERE tipo='$tipoVen'";

	      // if($tipoCVen=="ano")	//a�o
		// if($ano!=0)
  	          // $sql="SELECT * FROM ventas WHERE tipo='$tipoVen' AND ano='$ano'";
	     // // else
		// //$sql="SELECT * FROM ventas WHERE tipo='$tipoVen'";
	    // }



	  // $idcon=$this->objDB->select($sql); 
		 // while($row=$this->objDB->getRow($idcon))
		 // {
			// $ventas[] =$row;
		 // }
         // return $ventas;

	//}

	
  }
?>