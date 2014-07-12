<?PHP
  class GUIIntercolin{
  var $conf;
	var $objDB;
	
	function GUIIntercolin($conf){
		$this->conf=$conf;
		$this->conect();
	}
	
	function conect(){	
		require_once($this->conf["pathmodelo"]."DBMysql.php");
		include($this->conf["pathdb"]."db.php");
		$this->objDB=new DBMysql();
		$this->objDB->conect($db,$host,$user,$passwd);
	}
	
	function showIndex() { ?>
	
		<section>						
			<div id="carousel-home" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
				<li data-target="#carousel-home" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-home" data-slide-to="1"></li>
				<li data-target="#carousel-home" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
				<div class="item active">
					<img src="Content/Images/Slide1.png" alt="Slide1"/>
					<div class="carousel-caption">
						<h3>Slide 1</h3>
					</div>
				</div>
					<div class="item">
					  <img src="Content/Images/Slide1.png" alt="Slide1"/>
					  <div class="carousel-caption">
						<h3>Slide 2</h3>
						<p>This is a description</p>
					  </div>
					</div>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-home" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-home" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>			
		</section>
	<?PHP }
	

	function showAdminAnuncios(){?>		
		
		<section class="grid-results">	
			<h2>Administrar Inmuebles en Venta</h2>
			
			<div class="container-fluid grid-wrapper">
				<div class="row">					
					<div class="col-sm-4 col-md-4 col-lg-4">
						<div class="menu-admin add-item">						
							<a href="index.php?mod=admin&amp;op=agregaranuncio&amp;ban=0"><img src="Content/Images/icn-add.png" />Agregar</a>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<div class="menu-admin admin-items">
							
							<a href="index.php?mod=admin&amp;op=adminventa"><img src="Content/Images/icn-admin.png" />Administrar</a>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<!--<div class="menu-admin">
							
						</div>-->
					</div>
				</div>
			</div>
		</section>
	 <?PHP
	}
	 
	function showAgregarAnuncio($tipoInmuebles) { 		
			//$tipoInmuebles = var_export($tipoInmuebles, true);			
	?>
					
		<section id="agregarAnuncio" class="detalle-anuncio">
			<h2>Agregar Anuncio</h2>
			<form action="index.php?mod=admin&amp;op=agregaranuncio&amp;ban=1" method="POST" id="agregarAnuncioForm">
								
				<article class="detalle-top">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Zona:</label>
							<input type="text" id="zona" name="zona" required="required"/>									
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Colonia:</label>
							<input type="text" id="colonia" name="colonia" required="required"/>				
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Precio:</label>
							<input type="text" id="precio" name="precio" />					
						</div>				
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Tipo de inmueble</label>
							<input list="tipoInmueble" name="tipoInmueble" required="required">
							<datalist id="tipoInmueble">
							<select>
								<?php
									for($i=0; $i < count($tipoInmuebles); $i++)
									{ ?>
										<option value="<?php echo ucfirst($tipoInmuebles[$i]); ?>">
							  <?php } ?>		
							</select>			
							</datalist>
						</div>
					</div>
				</article>
				
				<aside class="detalle-top">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Plantas:</label>
							<input type="number" id="numPlantas" name="numPlantas" min="1" />
						</div>						
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Habitaciones</label>
							<input type="number" id="numCuartos" name="numCuartos" min="1" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>M.construccion</label>
							<input type="text" id="construccion" name="construccion" />
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>M.terreno</label>
							<input type="text" id="terreno" name="terreno" />
						</div>
					</div>	
				</aside>
				<article class="detalle-bottom">
					<label>Detalle del Anuncio</label>
					<textarea id="descripcion" name="descripcion"></textarea>
				</article>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<a id="agregarAnuncioSubmit" class="button submit">Guardar y Elegir imagenes</a>
					</div>
				</div>
			</form>
		</section>
		<section id="upload-images" class="detalle-anuncio">
			<fieldset class="carousel">				
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">							
													
							<form action="upload.php?action=uploadImages" class="dropzone">								  
								<h3>Click o arrastra las imagenes</h3>
							</form>
						
					</div>														
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<a id="agregarImagenes" class="button submit">Guardar</a>
					</div>
				</div>	
			</fieldset>				
		</section>
	
	<?php
	}
	 
	function showGetAdminVenta($ventaInmueble){?>				
		<section class="admin-results grid-results">	
			<h2>Inmuebles en Venta</h2>						
			<div class="container-fluid grid-wrapper">
				<div class="row">
					<?php 
						for($i=0; $i<count($ventaInmueble); $i++)
						{ ?>
							<div id="<?php echo $ventaInmueble[$i]["id"]; ?>" class="col-sm-3 col-md-3 col-lg-3">
								<p>
									<span></span>
								<?php
									$noImage = 0;									
									//if(isset($ventaInmueble[$i]["url_image"]) and $ventaInmueble[$i]["url_image"] != "")
									//{ 
										$directory = $this->conf['uploads'].$ventaInmueble[$i]["id"]."/";											
										if(file_exists($directory))
										{										
											$images = glob($directory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
											if($images)
											{
												$randomImage = $images[array_rand($images)]; 											
												?>
												<a href="index.php?mod=admin&amp;op=editaranuncio&amp;id=<?php echo $ventaInmueble[$i]["id"]; ?>&amp;ban=0"><img class="thumbnail" src="<?php echo $randomImage; ?>" alt="thumbnail"></a> 
									<?php	}
											else									
												$noImage = 1;
										}
										else
										{	$noImage = 1; }
									//}
									//else
									//{	$noImage = 1;  }
										
									if($noImage == 1)
									{ ?>
										<a href="index.php?mod=admin&amp;op=editaranuncio&amp;id=<?php echo $ventaInmueble[$i]["id"]; ?>&amp;ban=0"><img class="thumbnail" src="<?php echo $this->conf['images']?>default.png" alt="Image  default" ></a>
							  <?php } ?>
								</p>
								<div class="thumbnail-text">
									<div class="row">
										<div class="col-sm-4 col-md-4 col-lg-4">
											<label>Zona:</label>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-8">
											<span><?php echo $ventaInmueble[$i]["zona"]; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 col-md-4 col-lg-4">
											<label>Colonia:</label>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-8">
											<span><?php echo $ventaInmueble[$i]["colonia"]; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 col-md-4 col-lg-4">
											<label>Precio<?php //echo $ventaInmueble[$i]["moneda_precio"]; ?></label>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-8">
											<span><?php echo $ventaInmueble[$i]["precio"]; ?></span> 
											<span>Pesos</span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<label>Descripcion:</label>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-12">
											<textarea name="descripcion" readonly="true"><?php echo $ventaInmueble[$i]["descripcion"]; ?></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 col-md-4 col-lg-4">
											<label>Fecha pub:</label>
										</div>
										<div class="col-sm-8 col-md-8 col-lg-8">
											<span><?php echo $ventaInmueble[$i]["fecha_publicacion"]; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-5 col-md-5 col-lg-5">
											<!--<input type="submit" value="Guardar">-->
										</div>
										<div class="col-sm-2 col-md-2 col-lg-2">
										</div>
										<div class="col-sm-5 col-md-5 col-lg-5">
											<a class="button button-primary" href="index.php?mod=admin&amp;op=editaranuncio&amp;id=<?php echo $ventaInmueble[$i]["id"]; ?>&amp;ban=0">Editar</a>
										</div>
									</div>
								</div>	
							</div>
				<?php  	} ?>
				</div>
			</div>
		</section>
	 <?PHP
	} 
	 
	function showDetalleAnuncio($detalleAnuncio, $tipoInmuebles){ ?>
		<section id="adminEditAnuncio" class="detalle-anuncio">
			<h2>Modificar Anuncio</h2>
			<form action="index.php?mod=admin&amp;op=editaranuncio&amp;id=<?php echo $detalleAnuncio["id"]; ?>&amp;ban=1" method="POST">								
				<article class="detalle-top">
					<div class="row"> 
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Zona</label>
							<input type="text" name="zona" required value="<?php echo $detalleAnuncio["zona"]; ?>"/>									
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Colonia</label>
							<input type="text" name="colonia" required value="<?php echo $detalleAnuncio["colonia"]; ?>"/>				
						</div>
						<div class="precio col-sm-3 col-md-3 col-lg-3">
							<label>Precio</label>
							<input type="text" name="precio" value="<?php echo $detalleAnuncio["precio"]; ?>"/>					
							<span>Pesos</span>
						</div>				
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Tipo de inmueble</label>
							<input list="tipoInmueble" value="<?php echo ucfirst($detalleAnuncio["tipo_inmueble"]); ?>">
							<datalist id="tipoInmueble" required>
							<select name="tipoInmueble">
								<?php
									for($i=0; $i < count($tipoInmuebles); $i++)
									{ 
										if($detalleAnuncio["tipo_inmueble"] == $tipoInmuebles[$i])
										{ ?>
											
											<!--<option value="<?php echo ucfirst($tipoInmuebles[$i]); ?>" selectedIndex>-->
								<?php	} 
										//else
										//{ ?>
											<option value="<?php echo ucfirst($tipoInmuebles[$i]); ?>">
								<?php   //}
									} ?>		
							</select>			
							</datalist>
						</div>
					</div>	
				</article>				
								
				<aside class="detalle-top">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Plantas</label>
							<input type="number" name="numPlantas" min="1" value="<?php echo $detalleAnuncio["num_plantas"]; ?>"/>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>Habitaciones</label>
							<input type="number" name="numCuartos" min="0" value="<?php echo $detalleAnuncio["num_cuartos"]; ?>"/>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>M.construccion</label>
							<input type="text" name="construccion" value="<?php echo $detalleAnuncio["metros_construccion"]; ?>"/>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label>M.terreno</label>
							<input type="text" name="terreno" min="10" value="<?php echo $detalleAnuncio["metros_terreno"]; ?>"/>
						</div>
					</div>	
				</aside>
				<article class="detalle-bottom">
					<label>Detalle del Anuncio</label>
					<textarea name="descripcion" required="true"><?php echo $detalleAnuncio["descripcion"]; ?></textarea>
				</article>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<button type="submit" value="submit" class="button submit">Guardar Cambios</button>
					</div>
				</div>
			</form>	
		</section>
	<?php }
	 
	function showServicios(){?>
		<section class="servicios">
			<h2> Servicios </h2>
			<p>
				En INTERCOLIN al brindarle nuestros servicios nos comprometemos a trasmitirle  seguridad y respaldo al asesorarle en todos los pasos que requieren la compraventa  o traspaso de su inmueble. Contamos con innovadoras, formas y estrategias para buscar y comercializar su inmueble por medio de cartera de clientes potenciales ya con la investigaci�n y verificaci�n de cr�ditos.
			</p>
			<p>
				En INTERCOLIN entre otros servicios ofrecemos:
			</p>
			<fieldset>
				<div>				
					<img src="Content/Images/icn-asesoramiento.png">
					<p>Asesoramiento</p>
				</div>
				<div>				
					<img src="Content/Images/icn-checklist.png">
					<p>Verificacion de documentos</p>
				</div>
				<div>				
					<img src="Content/Images/icn-valoraciones.png">
					<p>Valoraciones</p>
				</div>
				<div>				
					<img src="Content/Images/icn-mercadotecnia.png">
					<p>Publicidad</p>
				</div>
			</fieldset>
		</section>
	 <?PHP
	}
  	
  }
?>