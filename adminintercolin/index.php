<?PHP
  //error_reporting (E_ALL  | E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Intercolin - Administrar</title>
        <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="Content/Styles/Plugins/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="Content/Styles/Plugins/jquery.ui.plupload.css" type="text/css" />
		<link rel="stylesheet" href="Content/Styles/Plugins/dropzone.css" type="text/css" />
		<link rel="stylesheet" href="Content/Styles/layout.css" type="text/css" />		
        <meta name="viewport" content="width=device-width" />        
    </head>
	<body>
		<header>
            <div>
				<img src="Content/Images/logoIntercolin.png" alt="logo Intercolin"/>
				<span>Realizando tus suenos...</span>
			</div>
			<nav class="navbar" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <!--<a class="navbar-brand" href="#">Brand</a>-->
					</div>
					<div class="collapse navbar-collapse" id="mainMenu">
                        <ul id="menu" class="nav navbar-nav">
                            <li><a href="index.php?mod=admin&amp;op=index">Home</a></li>
                            <li><a href="index.php?mod=admin&amp;op=adminanuncios">Venta</a></li>							
                            <li><a href="#">Renta</a></li>            
							<li><a href="index.php?mod=admin&amp;op=servicios">Servicios</a></li>
							<li><a href="#">Conocenos</a></li>
                        </ul>
					</div>
				</div>
			</nav>                           
        </header>	   
  <?PHP
		if(isset($_GET["mod"]))
			$mod=$_GET["mod"];	
		else
			$mod = "admin";
		if(isset($_GET["op"]))
			$op=$_GET["op"];
		else
			$op = "adminanuncios";
  ?>   
	   
   <p class="fecha"><?PHP $dia = date("d");
	  $mes = date("m");
	  $ano = date("y");
	  $fecha = date("d/m/y");
 	  $hora = date("h:i");
	  //echo $fecha; 
	  //echo "<BR>".$hora; ?></p>
   <?php include("include/config.php");

   switch($mod){
	case "admin":  				
			require_once($conf["pathcontrol"]."AdminIntercolin.php");
			$objAdminIntercolin= new AdminIntercolin($conf);
			$objAdminIntercolin->controlador($op);
		break;
	
   }
  ?>
  <footer>
	<nav class="navbar" role="navigation">
        <!--<ul>
            <li><a href="#">Mision</a></li>
            <li><a href="#">Vison</a></li>
            <li><a href="#">Contacto</a></li>
            <li><a href="#">Noticias</a></li>
            <li><a href="#">Ubicacion</a></li>
        </ul>-->
	</nav>
    </footer>	
 <script type="text/javascript" src="Content/Scripts/Plugins/jquery-1.9.0.js"></script>
 <script type="text/javascript" src="Content/Scripts/Plugins/bootstrap.js"></script>
 <script type="text/javascript" src="Content/Scripts/Plugins/carousel.js"></script> 
 <script type="text/javascript" src="Content/Scripts/Plugins/plupload.full.min.js"></script> 
 <script type="text/javascript" src="Content/Scripts/Plugins/dropzone.js"></script> 
 <script type="text/javascript" src="Content/Scripts/Admin.js"></script>
</body>
</html>