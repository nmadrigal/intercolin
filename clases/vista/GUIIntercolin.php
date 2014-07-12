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
					<img src="Content/Images/mexicoDF.png" alt="Ciudad de México"/>
					<div class="carousel-caption">
						<h3>México Distrito Federal</h3>
					</div>
				    </div>
				    <div class="item">
					  <img src="Content/Images/pachuca.png" alt="Pachuca Hidalgo"/>
					  <div class="carousel-caption">
						<h3>Pachuca</h3>
						<!--<p>This is a description</p>-->
					  </div>
			            </div>

                                    <div class="item">
					  <img src="Content/Images/cuernavaca.png" alt="Cuernavaca Morelos"/>
					  <div class="carousel-caption">
						<h3>Cuernavaca</h3>
						<!--<p>This is a description</p>-->
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
			<fieldset>	
                             	<h1>Intermediación Inmobiliaria</h1>
				<div class="search">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<h4>Busqueda Rapida</label>							
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<p>
									<label>Inmueble:</label>								
								</p>
							</div>
							<div class="col-sm-8 col-md-8 col-lg-8">
								<select>
									<option>Casas</option>
									<option>Departamentos</option>
									<option>Terrenos</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<p>
									<label>Zona:</label>								
								</p>
							</div>
							<div class="col-sm-8 col-md-8 col-lg-8">
								<select>
									<option>Centro</option>
									<option>Norte</option>
									<option>Sur</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<p>
									<label>Colonia:</label>								
								</p>
							</div>
							<div class="col-sm-8 col-md-8 col-lg-8">
								<select>
									<option></option>
									<option>Satelite</option>
									<option>Cd. Neza</option>
									<option>Gustavo A. Madero</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 col-md-4 col-lg-4">
								<p>
									<label>Precio:</label>								
								</p>
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<input type="text" placeholder="Min">							
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<input type="text" placeholder="Max">
							</div>
						</div>
						<div class="row">
							<!--<div class="col-sm-4 col-md-4 col-lg-4">
							</div>-->
							<div class="col-sm-12 col-md-12 col-lg-12">
								<a class="icn-search" href="#"><i></i></a>
							</div>
						</div>
					</div>							
				</div>
			
				<div class="row home">                                  
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p>En INTERCOLIN, somos un grupo de profesionales  comprometidos en brindarle asesoramiento práctico y gratuito durante todo el proceso de la intermediación inmobiliaria, ya que contamos con todos los conocimientos necesarios para una compraventa exitosa y sin contratiempos.</p>
                                  </div>
				</div>
			</fieldset>
		</section>
	<?PHP }
	

	function showGetVenta($ventaInmueble){?>		
		
		<section class="grid-results">	
			<h1>Inmuebles en Venta</h1>
			<!--
			<fieldset class="search">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<h4>Filtros</label>							
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<label>Inmueble:</label>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<select>
								<option>Casas</option>
								<option>Departamentos</option>
								<option>Terrenos</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							
								<label>Zona:</label>								
							
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<select>
								<option>Centro</option>
								<option>Norte</option>
								<option>Sur</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							
								<label>Colonia:</label>								
							
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<select>
								<option></option>
								<option>Satelite</option>
								<option>Cd. Neza</option>
								<option>Gustavo A. Madero</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<p>
								<label>Precio:</label>								
							</p>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<input type="text" placeholder="Min">							
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<input type="text" placeholder="Max">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">							
								<label>Plantas:</label>															
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input id="plantas" name="plantas" type="number" min="1" max="5" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">							
								<label>Ba�os:</label>															
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input id="banos" name="banos" type="number" min="1" max="5" step="0.5" />
						</div>
					</div>
					<div class="row">
						<!--<div class="col-sm-4 col-md-4 col-lg-4">
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<a class="icn-search" href="#"><i></i></a>
						</div>
					</div>
				</div>							
			</fieldset>
			-->	
			<div class="container-fluid grid-wrapper">
				<div class="row">
					<?php 
						for($i=0; $i<count($ventaInmueble); $i++)
						{ ?>
							<div class="col-sm-3 col-md-3 col-lg-3 thumbnail-anuncio">
								<p>
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
												<a href="index.php?mod=home&amp;op=detalleanuncio&amp;id=<?php echo $ventaInmueble[$i]["id"]; ?>"><img class="thumbnail" src="<?php echo $randomImage; ?>" alt="thumbnail"></a> 
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
										<a href="index.php?mod=home&amp;op=detalleanuncio&amp;id=<?php echo $ventaInmueble[$i]["id"]; ?>"><img class="thumbnail" src="<?php echo $this->conf['images']?>default.png" alt="Image  default" ></a>
							  <?php } ?>
								</p>
								<div class="thumbnail-text">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<label><?php echo $ventaInmueble[$i]["zona"]; ?></label> - <span><?php echo $ventaInmueble[$i]["colonia"]; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<label>$<?php echo $ventaInmueble[$i]["precio"]; ?></label><span> <?php echo $ventaInmueble[$i]["moneda_precio"]; ?></span>
										</div>
									</div>
									<!--<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12">
											<p><?php echo $ventaInmueble[$i]["descripcion"]; ?></p>											
										</div>
									</div>-->
									<span><?php echo $ventaInmueble[$i]["fecha_publicacion"]; ?></span>
								</div>	
							</div>
				<?php  	} ?>
				</div>
			</div>
		</section>
	 <?PHP
	}
	 
	function showDetalleAnuncio($detalleAnuncio){?>
		<section class="container-fluid detalle-anuncio">
			<article class="row detalle-top">
				<div  class="col-sm-3 col-md-3 col-lg-3">
					<h3><?php echo $detalleAnuncio["zona"]; ?></h3>				
					<span><?php echo $detalleAnuncio["colonia"]; ?></span>
				</div>
				<div  class="col-sm-3 col-md-3 col-lg-3">
					<h3><?php echo $detalleAnuncio["precio"]; ?></h3>
					<span>Precio</span>
				</div>
				<div  class="col-sm-3 col-md-3 col-lg-3">
					<h3><?php echo $detalleAnuncio["fecha_publicacion"]; ?></h3>				
					<span>Fecha de publicación</span>
				</div>
				<div  class="col-sm-3 col-md-3 col-lg-3">
					<h3><?php echo $detalleAnuncio["tipo_inmueble"]; ?></h3>
					<span>Venta</span>
				</div>
			</article>
			
			<?php
			$notFound = 0;			
			$directory = $this->conf['uploads'].$detalleAnuncio["id"];					
			$dirint = dir($directory); 
                        $items = scandir($directory);
			$items = count($items)-2;
                        if($items > 6)
			  $classThumb = "content-large";
                        else
                          $classThumb = "";
			$i = 0;
			if($notFound == 0)
			{ ?>
				<div id="carousel-detalle" class="carousel slide" data-ride="carousel">					
					<!-- Indicators -->
					<div class="carousel-thumbnails">
						<ol class="carousel-indicators <?php echo $classThumb; ?>">
							<?php																		
								while (($archivo = $dirint->read()) !== false)
								{									
									if($i == 0)
									{	$classIndicator = "active"; }
									else										
									{	$classIndicator = ""; }
										
									if (eregi("jpg", $archivo) || eregi("png", $archivo) || eregi("gif", $archivo)){ ?>																			
										<li data-target="#carousel-detalle" data-slide-to="<?php echo $i; ?>" class="thumbnail <?php echo $classIndicator; ?>"><?php echo '<img src="'.$directory."/".$archivo.'">'."\n"; ?></li>
								<?php   $i = $i+1;
									}								
								} ?>
						</ol>
					</div>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php	
							$directorySlide = $this->conf["uploads"].$detalleAnuncio["id"];
							 
							 if(isset($directorySlide) && file_exists($directorySlide))
								{ $dirintSlide = dir($directorySlide); }
						/*	 $j = 0;		
								$images = glob($directorySlide."/*.{png,jpg,jpeg}", GLOB_BRACE);
								foreach ($images as $image)
								{ 
									echo '<img src="'.$image.'">'."\n";
									//print "<img src=\"/$image\" />";
									
								}*/
								
								while (($archivoSlide = $dirintSlide->read()) !== false)
								{ 
									if($j == 0)
									{	$class = "active"; }
									else
									{	$class = ""; }
																		
									if (eregi("jpg", $archivoSlide) || eregi("png", $archivoSlide) || eregi("gif", $archivoSlide)){																		
										 ?>	
											<div class="item <?php echo $class; ?>">																								
												<?php echo '<img src="'.$directorySlide."/".$archivoSlide.'">'."\n"; ?>
												<!--<div class="carousel-caption">
													<h3>Slide 1</h3>
												</div>-->
											</div>
									<?php 	$j = $j+1;
										}									
								}
								$dirint->close();												
							?>
									
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-detalle" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-detalle" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
	<?php   } ?>		
			<aside class="detalle-right">
				<div>
					<h3>Plantas</h3>
					<span><?php echo $detalleAnuncio["num_plantas"]; ?></span>
				</div>
				<div>
					<h3>Habitaciones</h3>
					<span><?php echo $detalleAnuncio["num_cuartos"]; ?></span>
				</div>
				<div>
					<h3>M.construccion</h3>
					<span><?php echo $detalleAnuncio["metros_construccion"]; ?></span>
				</div>
				<div>
					<h3>M.terreno</h3>
					<span><?php echo $detalleAnuncio["metros_terreno"]; ?></span>
				</div>
			</aside>
			<article class="row detalle-bottom">
                              <div class="col-lg-12 col-md-12 col-sm-12">
				<h3>Detalle del Anuncio</h3>
				<div><p><?php echo $detalleAnuncio["descripcion"]; ?></p></div>
                              </div>
			</article>
		</section>
	<?php }
	 
	function showServicios(){?>
		<section class="servicios">
			<h1>Servicios</h1>
			<p>
				En INTERCOLIN, al brindarle nuestros servicios nos comprometemos a trasmitirle  seguridad y respaldo al asesorarle en todos los pasos que requieren la compraventa  o traspaso de su inmueble. Contamos con innovadoras, formas y estrategias para buscar y comercializar su inmueble, por medio de cartera de clientes potenciales ya con la investigación y verificación de créditos.
			</p>
			<p>
				En INTERCOLIN entre otros servicios ofrecemos:
			</p>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				
					<img src="Content/Images/asesoria.png">
					<h3>Asesoramiento</h3>
                                        <p>Para INTERCOLIN, el asesoramiento veras y oportuno es la base fundamental para que  tanto comprador como vendedor tengan la plena seguridad y depositen su confianza en nosotros, por lo cual se le explicará todo el proceso para una  compra-venta del inmueble con éxito.</p>
				</div>                                				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				
					<img src="Content/Images/check-docs.png">
					<h3>Verificación de documentos</h3>
                                        <p>Es para INTERCOLIN, de suma importancia el checar minusiosamente cada uno de los documentos ya sea para comprar o para vender, con lo cual se puede ahorrar tiempo y dinero y poder asegurar una compra-venta sin contratiempos.</p>
				</div>
                          </div>
                          <div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				
					<img src="Content/Images/valoracion.png">
					<h3>Valoraciones</h3>
                                        <p>Uno de los principales pasos para vender o comprar una propiedad en el menor tiempo posible es saber o tener un panorama real del precio del inmueble, por lo tanto INTERCOLIN le orientará por medio de nuestra experiencia y diferentes avalúos semejantes en la zona y mercadeo si su propiedad está en el rango del precio.</p>
				</div>				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				
					<img src="Content/Images/publicidad.png">
					<h3>Publicidad</h3>
                                        <p>En INTERCOLIN, toda publicidad es gratuita y nuestras formas son por medio de revistas, periódico, paginas de internet , mantas, volantes y lo mas importante que contamos
                   con una cartera de clientes potenciales.</p>
				</div>
			</div>
		</section>
	 <?PHP
	}
  	
        function showContacto(){?>
        <section>
          <h1>Conócenos</h1>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <p>Nosotros sabemos que el vender o comprar una propiedad es una de las decisiones más importantes ya que es es el patrimonio de su familia, es por eso que INTERCOLIN le ofrece una asesoría profesional y gratuita, para llevar a buen término la operación que necesite realizar, le agradecemos de antemano que nos brinde la oportunidad de servirle. </p>
            </div>
          </div>
        </section>          
        <section class="ubicacion">
           <h2>Ubicanos</h2>
           <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12">
               <p>
			     <label>PACHUCA</label>
				 AV. MADERO 501-A ESQ. RIO DE LAS AVENIDAS COL. CENTRO PACHUCA HIDALGO TEL.(01 771) 294 2479 ID 72*13*81834 CELL. 771 220 4070
               <p>
             </div>
           </div>
          <!--<div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
              <p>
                 <label> Usted puede contactarse con </label>
                 <label>Javier Colin</label>
                 <label>Carlos Colin</label>
                 TEL: 4992 4537 y 4119 7755 cell. 55 3983 7189
              <p>
            </div>
          </div>-->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m22!1m12!1m3!1d3746.3666707040666!2d-98.73426112806399!3d20.118744813893958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m7!1i0!3e6!4m3!3m2!1d20.1190622!2d-98.73459369999999!4m0!5e0!3m2!1ses!2smx!4v1403493295253"  frameborder="0" style="border:0"></iframe> -->
				<div id="map-canvas"></div>
            </div>
          </div>
        </section>
		<section class="contacto">
			<h2>Contactanos</h2>
			<div class="row">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<form id="contactForm" action="index.php?mod=home&amp;op=contacto&amp;ban=1" method="POST">
						<div class="row">
							<p class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Nombre</label>
								<input id="nombre" type="text" name="nombre">
							</p>
							<p class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Apellido</label>
								<input id="apellido" type="text" name="apellido">
							</p>
						</div>
						<div class="row">
							<p class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Correo electrónico</label>
								<input id="email" type="email" name="email">
							</p>
							<p class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Teléfono</label>
								<input id="tel" type="tel" name="tel">
							</p>
						</div>
						<div class="row">
							<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Tema</label>
								<input id="subj" type="text" name="subj">
							</p>
						</div>
						<div class="row">
							<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Mensaje</label>
								<textarea id="mensaje" name="mensaje"></textarea>
							</p>
						</div>
						<div class="row">
							<p class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<input id="sendEmailButton" type="button" value="Enviar">
							</p>
						</div>
					</form>
				</div>
			</div>			
		</section>
        <?PHP
       }

  }
?>