
$(document).ready(function () {
    Admin.Index.Init();
});

var Admin = Admin || {};
(function (Admin,$, undefined) {

    var latLng = "";
    Admin.Index = function () {
        function init() {
                       
            initControls();
            initEvents();

        }
		
		function initControls() {
		
			//maps
			//initMaps();
			
			noop = function() {};
			Dropzone.prototype.defaultOptions = {
			  url: null,
			  method: "post",
			  withCredentials: false,
			  parallelUploads: 2,
			  uploadMultiple: false,
			  maxFilesize: 256,
			  paramName: "file",
			  createImageThumbnails: true,
			  maxThumbnailFilesize: 10,
			  thumbnailWidth: 100,
			  thumbnailHeight: 100,
			  maxFiles: null,
			  params: {},
			  clickable: true,
			  ignoreHiddenFiles: true,
			  acceptedFiles: null,
			  acceptedMimeTypes: null,
			  autoProcessQueue: true,
			  addRemoveLinks: true,
			  previewsContainer: null,
			  dictDefaultMessage: "Drop files here to upload",
			  dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
			  dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
			  dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
			  dictInvalidFileType: "You can't upload files of this type.",
			  dictResponseError: "Server responded with {{statusCode}} code.",
			  dictCancelUpload: "Cancel upload",
			  dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
			  dictRemoveFile: "Quitar Imagen",
			  dictRemoveFileConfirmation: null,
			  dictMaxFilesExceeded: "No puede subir mas imagenes",
			  accept: function(file, done) {				
				return done();
			  },
			  init: function() {				
				return noop;
			  },
			  forceFallback: false,
			  fallback: function() {			  
				var child, messageElement, span, _i, _len, _ref;
				this.element.className = "" + this.element.className + " dz-browser-not-supported";
				_ref = this.element.getElementsByTagName("div");
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
				  child = _ref[_i];
				  if (/(^| )dz-message($| )/.test(child.className)) {
					messageElement = child;
					child.className = "dz-message";
					continue;
				  }
				}
				if (!messageElement) {
				  messageElement = Dropzone.createElement("<div class=\"dz-message\"><span></span></div>");
				  this.element.appendChild(messageElement);
				}
				span = messageElement.getElementsByTagName("span")[0];
				if (span) {
				  span.textContent = this.options.dictFallbackMessage;
				}
				return this.element.appendChild(this.getFallbackForm());
			  },
			  resize: function(file) {
				var info, srcRatio, trgRatio;
				info = {
				  srcX: 0,
				  srcY: 0,
				  // srcWidth: file.width,
				  // srcHeight: file.height
				  srcWidth: 800,
				  srcHeight: 600
				};
				srcRatio = file.width / file.height;
				trgRatio = this.options.thumbnailWidth / this.options.thumbnailHeight;
				if (file.height < this.options.thumbnailHeight || file.width < this.options.thumbnailWidth) {
				  info.trgHeight = info.srcHeight;
				  info.trgWidth = info.srcWidth;
				} else {
				  if (srcRatio > trgRatio) {
					info.srcHeight = file.height;
					info.srcWidth = info.srcHeight * trgRatio;
				  } else {
					info.srcWidth = file.width;
					info.srcHeight = info.srcWidth / trgRatio;
				  }
				}
				info.srcX = (file.width - info.srcWidth) / 2;
				info.srcY = (file.height - info.srcHeight) / 2;
				return info;
			  },
			  /*
			  Those functions register themselves to the events on init and handle all
			  the user interface specific stuff. Overwriting them won't break the upload
			  but can break the way it's displayed.
			  You can overwrite them if you don't like the default behavior. If you just
			  want to add an additional event handler, register it on the dropzone object
			  and don't overwrite those options.
			  */

			  drop: function(e) {
				return this.element.classList.remove("dz-drag-hover");
			  },
			  dragstart: noop,
			  dragend: function(e) {
				return this.element.classList.remove("dz-drag-hover");
			  },
			  dragenter: function(e) {
				return this.element.classList.add("dz-drag-hover");
			  },
			  dragover: function(e) {
				return this.element.classList.add("dz-drag-hover");
			  },
			  dragleave: function(e) {
				return this.element.classList.remove("dz-drag-hover");
			  },
			  paste: noop,
			  reset: function() {
				return this.element.classList.remove("dz-started");
			  },
			  addedfile: function(file) {				 
				var node, removeFileEvent, removeLink, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results,
				  _this = this;
				if (this.element === this.previewsContainer) {
				  this.element.classList.add("dz-started");
				}
		
				file.previewElement = Dropzone.createElement(this.options.previewTemplate.trim());
				file.previewTemplate = file.previewElement;
				this.previewsContainer.appendChild(file.previewElement);
				_ref = file.previewElement.querySelectorAll("[data-dz-name]");
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
				  node = _ref[_i];
				  node.textContent = file.name;
				}
				_ref1 = file.previewElement.querySelectorAll("[data-dz-size]");
				for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
				  node = _ref1[_j];
				  node.innerHTML = this.filesize(file.size);
				}
				if (this.options.addRemoveLinks) {
				  file._removeLink = Dropzone.createElement("<a id='"+ file.name + "' class=\"dz-remove\" href=\"javascript:undefined;\" data-dz-remove>" + this.options.dictRemoveFile + "</a>");
				  file.previewElement.appendChild(file._removeLink);
				}
				removeFileEvent = function(e) {
				  e.preventDefault();
				  e.stopPropagation();
				  if (file.status === Dropzone.UPLOADING) {
					return Dropzone.confirm(_this.options.dictCancelUploadConfirmation, function() {
					  return _this.removeFile(file);
					});
				  } else {
					if (_this.options.dictRemoveFileConfirmation) {
					  return Dropzone.confirm(_this.options.dictRemoveFileConfirmation, function() {						
						return _this.removeFile(file);						
					  });
					} else {						
					  return _this.removeFile(file);
					}
				  }
				};
				_ref2 = file.previewElement.querySelectorAll("[data-dz-remove]");
				_results = [];
				for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
				  removeLink = _ref2[_k];
				  _results.push(removeLink.addEventListener("click", removeFileEvent));
				}
				return _results;
			  },
			  removedfile: function(file) {
				var _ref;
				if ((_ref = file.previewElement) != null) {
				  _ref.parentNode.removeChild(file.previewElement);
				}
				jQuery.ajax({
					type: "POST",
					url: 'upload.php',					
					data: { "action": "removeImage", "remove": file.name},
					success: function (data) {
								  
							}
				});
				return this._updateMaxFilesReachedClass();
			  },
			  thumbnail: function(file, dataUrl) {
				var thumbnailElement, _i, _len, _ref, _results;
				file.previewElement.classList.remove("dz-file-preview");
				file.previewElement.classList.add("dz-image-preview");
				_ref = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
				  thumbnailElement = _ref[_i];
				  thumbnailElement.alt = file.name;
				  _results.push(thumbnailElement.src = dataUrl);
				}
				return _results;
			  },
			  error: function(file, message) {
				var node, _i, _len, _ref, _results;
				file.previewElement.classList.add("dz-error");
				if (typeof message !== "String" && message.error) {
				  message = message.error;
				}
				_ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
				  node = _ref[_i];
				  _results.push(node.textContent = message);
				}
				return _results;
			  },
			  errormultiple: noop,
			  processing: function(file) {
				file.previewElement.classList.add("dz-processing");
				if (file._removeLink) {
				  return file._removeLink.textContent = this.options.dictCancelUpload;
				}
			  },
			  processingmultiple: noop,
			  uploadprogress: function(file, progress, bytesSent) {
				var node, _i, _len, _ref, _results;
				_ref = file.previewElement.querySelectorAll("[data-dz-uploadprogress]");
				_results = [];
				for (_i = 0, _len = _ref.length; _i < _len; _i++) {
				  node = _ref[_i];
				  _results.push(node.style.width = "" + progress + "%");
				}
				return _results;
			  },
			  totaluploadprogress: noop,
			  sending: function(file, xhr, formData) {				
				},
			  sendingmultiple: noop,
			  success: function(file) {
				return file.previewElement.classList.add("dz-success");
			  },
			  successmultiple: noop,
			  canceled: function(file) {
				return this.emit("error", file, "Carga cancelada.");
			  },
			  canceledmultiple: noop,
			  complete: function(file) {
				if (file._removeLink) {
				  return file._removeLink.textContent = this.options.dictRemoveFile;
				}
			  },
			  completemultiple: noop,
			  maxfilesexceeded: noop,
			  maxfilesreached: noop,
			  previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>"
			};					
			
        }
		
		function initAddMap () {
			var direccion = "add";
			initMaps(direccion);
		}
		
		//function initEditMap (direccion) {			
			//initMaps(direccion);
		//}
		
		function initMaps(direccion){
			var markers = [];
			var centerPosition;
			if(direccion == "add" || !direccion)
				centerPosition = new google.maps.LatLng(20.119021, -98.734370); //20.119218, -98.734287
			else{
				var split = direccion.split(",")
				centerPosition = new google.maps.LatLng(parseFloat(split[0]),parseFloat(split[1]));
			}
				
			var mapOptions = {				
				center: centerPosition,
				zoom: 14,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			// google.maps.event.addListener(map, "rightclick", function(e){				
				// var newMarkerPosition = e.latLng;
				// latLng = newMarkerPosition.toString().replace('(', '');
					// latLng = latLng.replace(')', '')
				// var urlToGetAddress = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+ latLng + "&sensor=true_or_false";
				
				// $.ajax({
					// url: urlToGetAddress,
					// type: "POST",
					// success: function (response){
						// console.log(response.results);
						// //infoWindow = response.results[0].formatted_address;
						// setupMarker(response.results,newMarkerPosition);
					// },
					// error: function (err, error){
						// console.log(err.description);
					// }
				// });
				
				
			// });
			setupMarker(centerPosition);
			
			function setupMarker(newMarkerPosition){
				var infoWindow;
				if(markers.length > 0){
					for (var i = 0; i < markers.length; i++) {
						markers[i].setMap(null);
					}
					markers = [];
				}
				
				// if(location.length > 1)
				// {	
					// var address = "<select class='address-location'>";
					// for(var i=0; i < location.length; i++)
					// {	
						// if(location[i].address_components.length > 3)
							// address += "<option value='" + location[i].formatted_address + "'>" + location[i].formatted_address + "</option>";
					// }
					// address += "</select>";
					// console.log(address);
					// $("#agregarAnuncioForm .direccion").val(location[0].formatted_address);
				// }
				
				var newMarker = new google.maps.Marker({
					position: newMarkerPosition,
					map: map,
					title: "Nueva ubicación",
					//info: address,
					draggable: true
				});
				var info = new google.maps.InfoWindow({
					content: newMarker['info']
				});
				
				var geoCodergetDirection = new google.maps.Geocoder();
				if (geoCodergetDirection) {
					geoCodergetDirection.geocode({ location: centerPosition }, callbackData);
					$(".direccion").attr("data-location", 0);
				}        
				
				google.maps.event.addListener(newMarker, "dragend", function(e) {				
					var geoCodergetDirection = new google.maps.Geocoder();
					if (geoCodergetDirection) {
						geoCodergetDirection.geocode({ location: e.latLng }, callbackData);
						$(".direccion").attr("data-location", 1);
					}        

				});
				//info.open(map,newMarker);
				markers.push(newMarker);
				for (var i = 0; i < markers.length; i++) {
					markers[i].setMap(map);
			    }
				
			}
			
			function callbackData(results, status) {
				var newData = {};           
				if (status == google.maps.GeocoderStatus.OK) {					
					for (x = 0; x < results.length; x++) {
						var obj = results[x];                    						
						newData.latitude = results[x].geometry.location.lat();
						newData.longitude = results[x].geometry.location.lng();                
						for (i = 0; i < obj.address_components.length; i++) {
							var o = obj.address_components[i];
							switch (o.types[0]) {
								case "street_number":
									newData.streetnumber = o.long_name;
									break;
								case "route":
									newData.street = o.long_name;
									break;
								case "neighborhood":
									newData.neighborhood = o.long_name;
								case "locality":
									newData.city = o.long_name;
									break;
								case "administrative_area_level_1":
									newData.state = o.long_name;
									break;
								case "country":
									newData.country = o.long_name;
									break;
							}
						};
					};
					
					latLng = results[0].geometry.location.lat() + "," + results[0].geometry.location.lng();
					$(".direccion").val(newData.street + ", " + newData.streetnumber + ", " + newData.neighborhood + ", " + newData.city + ", " + newData.state + ", " + newData.country);
					// _container.find(".latLng").val(newData.latitude + ", " + newData.longitude);
					// _container.find(".stNumber").val(newData.streetnumber);
					// _container.find(".stName").val(newData.street);
					// _container.find(".city").val(newData.city);
					// _container.find(".state").val(newData.state);
					// _container.find(".country").val(newData.country);
				
				}
			}
			
		}
						
		function submitData (required,el,action) { //el = is the view or form
			if(!required){																	
					var zona = el.find("#zona").val();
					var colonia = el.find("#colonia").val();
					var precio = el.find("#precio").val();
					var tipoInmueble = el.find("input[name='tipoInmueble']").val();
					var numPlantas = el.find("#numPlantas").val();
					var numCuartos = el.find("#numCuartos").val();
					var construccion = el.find("#construccion").val();
					var terreno = el.find("#terreno").val();
					var descripcion = el.find("#descripcion").val();
					var	direccion = '';
					if($("#agregarAnuncioForm .direccion").attr("data-location") == 1 || $("#agregarAnuncioForm .direccion").attr("data-location") == "1")
						direccion = el.find(".direccion").val();
								
					if(action == "add"){
						jQuery.ajax({
							type: 'POST',							
							url: 'clases/control/functions.php',
							data: { 'op': "agregarAnuncio", 'zona': zona, 'colonia': colonia, 'precio': precio, 'tipoInmueble': tipoInmueble, 'numPlantas': numPlantas, 'numCuartos': numCuartos, 'construccion': construccion, 'terreno': terreno, 'descripcion': descripcion, 'latLng': latLng, 'direccion': direccion },
							cache: false,
							success: function (response){	
									console.log(response);
									$("#agregarAnuncio").fadeOut('slow');
									$("#upload-images .dropzone").append("<input type='hidden' name='id' id='lastID' value='" + response + "'>");
									$("#upload-images").fadeIn('slow');								
							}
							
						});
					}
					if(action == "edit"){
						var idAnuncio = el.find("#idAnuncio").val();					
						 jQuery.ajax({
							 type: 'POST',							 
							 url: 'clases/control/functions.php',
							 data: { 'op': "editarAnuncio", 'zona': zona, 'colonia': colonia, 'precio': precio, 'tipoInmueble': tipoInmueble, 'numPlantas': numPlantas, 'numCuartos': numCuartos, 'construccion': construccion, 'terreno': terreno, 'descripcion': descripcion, 'latLng': latLng, 'direccion': direccion,'idAnuncio': idAnuncio },
							 cache: true,
							 success: function (response){																			 
									 if(response == 1)
										alert("Los datos se guardaron correctamente");
									 $("#uploadEditImages .dropzone").append("<input type='hidden' name='id' id='lastID' value='" + response + "'>");									 
							 }							
						 });
					}					
			}
			else
			{
				el.find(".requeridos").remove();
				var warning = "<div class='requeridos'><p>Por favor, llene los campos obligatorios</p></div>";
				el.prepend(warning);
				el.find(".requeridos").fadeIn().delay(3000).fadeOut();
						
			}
		}
		
		function validateForm(el){
		  var required = false;
			el.find("*[required]").each(function () {	
					var _this = $(this); 
					if(_this.attr("id") == "tipoInmueble")
						_this = el.find("[list*='tipoInmueble']");
						
					if (_this.val() == "")
					{ required = true; $(this).addClass("required"); }
					else
					{ $(this).removeClass("required"); }
					
				});
			
			return required;
		}
		
		function saveImages(idAnuncio,action){
			jQuery.ajax({
				type: 'POST',
				//url: 'index.php?mod=admin&op=agregaranuncio&ban=1',
				url: 'upload.php',
				data: { 'action': "moveImages", 'idAnuncio': idAnuncio },
				cache: true,
				success: function (response){										
						if(action == "add")
							window.location.href = "index.php?mod=admin&op=adminanuncios";
						if(action == "edit"){
							$("#uploadEditImages").hide();
							$("#manageImages").show();							
						}
						if(response != 0)
							alert("Las imágenes se guardaron correctamente");																
				}						
			});		
		}
		
		function getImagesStored(el,idAnuncio) {
			jQuery.ajax({
					type: 'POST',					
					url: 'upload.php',
					data: { 'action': "changeImages", 'idAnuncio': idAnuncio },
					cache: true,
					success: function (response){	
							if($("#uploadEditImages #editDropzone ul").length != 0 || $("#uploadEditImages #editDropzone div.dz-success").length != 0){
								 $("#uploadEditImages #editDropzone div.dz-success").remove();
								 $("#uploadEditImages #editDropzone ul").remove();								
							}
							var imagesStored = "<ul>";
							$.each(response, function(key,value){										 
								var mockFile = { name: value.name, size: value.size };
								imagesStored += "<li class='dz-preview dz-image-preview'><img src='" + '/uploads/' + idAnuncio + '/' + value.name + "' alt='" + value.name + "' width='100' /><a id='" + value.name + "' class='dz-remove' data-dz-remove=''>Quitar Imagen</a></li>";
							});
							imagesStored += "</ul>";
							$("#editDropzone").append(imagesStored);
							$("li.dz-preview .dz-remove").bind("click", function(e){
								var fileName = $(this).attr("id");								
								jQuery.ajax({
									type: "POST",
									url: 'upload.php',					
									data: { "action": "removeImage", "remove": fileName, "idAnuncio": idAnuncio},
									success: function (data) {
												getImagesStored(el,idAnuncio);
											}
								});
							
								e.preventDefault();
							});
							
							
							// window.location.href = "index.php?mod=admin&op=adminanuncios";
							// alert("Las imágenes se guardaron correctamente");																
							
					
					}								
				});
		}
		
		function initEvents() {
			var required;			
			//agregaranuncio
			$("#agregarAnuncioSubmit").bind("click", function (){				
				var element = $('#agregarAnuncioForm');				
				required = validateForm(element);				
				submitData(required,element,action="add")
				
			});
			
			//agregar imagenes
			$("#upload-images #agregarImagenes").bind("click", function(e){
				e.preventDefault();
				var id = $("#upload-images #lastID").val();				
				saveImages(id,"add");
			});
				
			$("#editarAnuncioSubmit").bind("click", function (){				
				var element = $('#editarAnuncioForm');				
				required = validateForm(element);				
				submitData(required,element,action="edit")				
			});
			
			$("#manageImages").bind("click", function (e){
				var el = $('#editarAnuncioForm');
				var idAnuncio = el.find("#idAnuncio").val();
				$(this).hide();				
				 	
				getImagesStored(el,idAnuncio);									
				$("#uploadEditImages").show();
				e.preventDefault();
			});
			
			$("#saveImages").bind("click", function(e){
				var el = $('#editarAnuncioForm');
				var idAnuncio = el.find("#idAnuncio").val();
				saveImages(idAnuncio,"edit");
				e.preventDefault();
			});
			
			//eliminar anuncio
			$('.admin-results .icn-delete').bind("click", function () {
				var id = $(this).parent().parent().attr("id");				
				var con = confirm("Desea eliminar el anuncio?");
				if(con == true){					
					 jQuery.ajax({
						type: "POST",
						url: 'clases/control/EliminarAnuncio.php',					
						data: {'idAnuncio':  id},
						cache: false,
						success: function (result) {							
							if(result)
							{
								   $(".admin-results .container-fluid #" + id).fadeOut('slow', function () {
									 $(this).remove();
									   });									  
							}	
						 }
					 });
				}
				
				
			});					

        }
		// function readURL(input) {
			// if (input.files && input.files[0]) {
            // var reader = new FileReader();
            
            // reader.onload = function (e) {
                // $('#image1').attr('src', e.target.result);
            // }
            
            // reader.readAsDataURL(input.files[0]);
			// }
		// }
        return {
            Init: init,
			InitAddMap: initAddMap,
            InitMaps: initMaps
        };

    }();

	Admin.Index.InitEditMap = function (lat,lng) {
		var direccion = lat +  ", "+ lng;
		Admin.Index.InitMaps(direccion);
	}
})(Admin,jQuery);
