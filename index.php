<?PHP
  //error_reporting (E_ALL  | E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta name="description" content="Intercolin - Intermediación Inmobiliaria, servicios de asesoramiento en la venta de casas y departamentos">
        <title>Intercolin</title>
        <link href="/Content/Images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" href="Content/Styles/Plugins/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="Content/Styles/layout.css" type="text/css" />	
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>		
        <meta name="viewport" content="width=device-width" />        
    </head>
	<body>
		<header>
            <div>
				<a href="./"><img src="Content/Images/logoIntercolin.png" alt="Intermediacion Intercolin"/></a>
				<span>Realizando tus sueños...</span>
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
					</div>
					<div class="collapse navbar-collapse" id="mainMenu">
                        <ul id="menu" class="nav navbar-nav">
                            <li><a href="./">Home</a></li>
                            <li><a href="index.php?mod=home&amp;op=venta">Venta</a>								
							</li>							
                            <!--<li><a href="#">Renta</a>								
							</li>-->            
							<li><a href="index.php?mod=home&amp;op=servicios">Servicios</a></li>
							<li><a href="index.php?mod=home&amp;op=contacto&amp;ban=0">Contacto</a></li>
                        </ul>
					</div>
				</div>
			</nav>                           
        </header>	   
 <?PHP
		if(isset($_GET["mod"]))
			$mod=$_GET["mod"];	
		else
			$mod = "home";
		if(isset($_GET["op"]))
			$op=$_GET["op"];
		else
			$op = "index";
	include("include/config.php");

   switch($mod){
	case "home":  				
			require_once($conf["pathcontrol"]."AdminIntercolin.php");
			$objAdminIntercolin= new AdminIntercolin($conf);
			$objAdminIntercolin->controlador($op);
		break;
	
   }
  ?>
  <footer>        
	<!-- <nav class="navbar" role="navigation">
         <ul>
            <li><a href="#">Mision</a></li>
            <li><a href="#">Vison</a></li>
            <li><a href="#">Contacto</a></li>
            <li><a href="#">Noticias</a></li>
            <li><a href="#">Ubicacion</a></li>
        </ul>
	</nav>-->
        <section class="row">	
		  <h1>Teléfonos</h1>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<h4>Oficina en Pachuca</h4>
            <p>
				<span></span>
                               <ul>
                                 <li><label>2942479</label></li>
                                 <li><label>771-2204070</label></li>
                                 <li><label> 771-2798588</label></li>
                               </ul>
			</p>
          </div>        
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<h4>Oficina en la Ciudad de México</h4>
			<p>
				<span></span>
                                 <ul>
                                   <li><label>4992 4537</label></li>
                                   <li><label>(Cel.) 5539837189</label></li>
                                 </ul>
			</p>
          </div>
        </section>
    </footer>	
 <script type="text/javascript" src="Content/Scripts/Plugins/jquery-1.9.0.js"></script>
 <script type="text/javascript" src="Content/Scripts/Plugins/bootstrap.js"></script>
 <script type="text/javascript" src="Content/Scripts/Plugins/carousel.js"></script>
 <script type="text/javascript" src="Content/Scripts/Home.js"></script>
 <script type="text/javascript" src="Content/Scripts/Contacto.js"></script>
</body>
</html>