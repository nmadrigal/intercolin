﻿
$(document).ready(function () {
    Admin.Index.Init();
});

var Admin = Admin || {};
(function ($, undefined) {

    
    Admin.Index = function () {
        function init() {
                       
            initControls();
            initEvents();

        }
		
		function initControls() {
						 
					// var uploader = new plupload.Uploader({
					  // browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
					  // url: 'upload.php'
					// });
					 
					// uploader.init();
					 
					// uploader.bind('FilesAdded', function(up, files) {
					  // var html = '';
					  // plupload.each(files, function(file) {
						// html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
					  // });
					  // document.getElementById('filelist').innerHTML += html;
					// });
					 
					// uploader.bind('UploadProgress', function(up, file) {
					  // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
					// });
					 
					// uploader.bind('Error', function(up, err) {
					  // document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
					// });
					 
					// document.getElementById('start-upload').onclick = function() {
					  // uploader.start();
					// };			 			
			
			
				// Dropzone.options.dropzoneForm = {
				// // The camelized version of the ID of the form element
				// paramName: "files",
				// autoProcessQueue: false,
				// uploadMultiple: true,
				// parallelUploads: 100,
				// maxFiles: 100,
				// previewsContainer: ".dropzone-previews",
				// clickable: true,
				// dictDefaultMessage: 'Add files to upload by clicking or droppng them here.',
				// addRemoveLinks: true,
				// acceptedFiles: '.jpg,.pdf,.png,.bmp',
				// dictInvalidFileType: 'This file type is not supported.',

				// // The setting up of the dropzone
				// init: function () {
					// var myDropzone = this;

					// $("button[type=submit]").bind("click", function (e) {
						// e.preventDefault();
						// e.stopPropagation();
						// // If the user has selected at least one file, AJAX them over.
						// if (myDropzone.files.length !== 0) {
							// myDropzone.processQueue();
						// // Else just submit the form and move on.
						// } else {
							// $('#dropzone-form').submit();
						// }
					// });

					// this.on("successmultiple", function (files, response) {
						// // After successfully sending the files, submit the form and move on.
						// $('#dropzone-form').submit();
					// });
				// }
			// }
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

        function initEvents() {
			var addRequired;
			//agregaranuncio
			$("#agregarAnuncioSubmit").bind("click", function (){
				addRequired = false;
			   $("#agregarAnuncioForm").find("*[required]").each(function () {										
					if ($(this).val() == "")
					{ addRequired = true; $(this).addClass("required"); }
					else
					{ $(this).removeClass("required"); }								
				});
				if(!addRequired){											
					$("#agregarAnuncioSubmit").bind("click", function (e){
						e.preventDefault();
						var zona = $("#zona").val();
						var colonia = $("#colonia").val();
						var precio = $("#precio").val();
						var tipoInmueble = $("input[name='tipoInmueble']").val();
						var numPlantas = $("#numPlantas").val();
						var numCuartos = $("#numCuartos").val();
						var construccion = $("#construccion").val();
						var terreno = $("#terreno").val();
						var descripcion = $("#descripcion").val();
						
						jQuery.ajax({
							type: 'POST',
							//url: 'index.php?mod=admin&op=agregaranuncio&ban=1',
							url: 'clases/control/functions.php',
							data: { 'op': "agregarAnuncio", 'zona': zona, 'colonia': colonia, 'precio': precio, 'tipoInmueble': tipoInmueble, 'numPlantas': numPlantas, 'numCuartos': numCuartos, 'construccion': construccion, 'terreno': terreno, 'descripcion': descripcion },
							cache: true,
							success: function (response){										
									$("#agregarAnuncio").fadeOut('slow');
									$("#upload-images .dropzone").append("<input type='hidden' name='id' id='lastID' value='" + response + "'>");
									$("#upload-images").fadeIn('slow');								
							}
							
						});
					});	
						
				}
				else
				{
					$("#agregarAnuncioForm .requeridos").remove();
					var warning = "<div class='requeridos'><p>Por favor, llene los campos obligatorios</p></div>";
					$("#agregarAnuncioForm").prepend(warning);
					$("#agregarAnuncio .requeridos").fadeIn().delay(3000).fadeOut();
							
				}
			});
			//agregar imagenes
			$("#upload-images #agregarImagenes").bind("click", function(e){
				e.preventDefault();
				var id = $("#upload-images #lastID").val();
				jQuery.ajax({
							type: 'POST',
							//url: 'index.php?mod=admin&op=agregaranuncio&ban=1',
							url: 'upload.php',
							data: { 'action': "moveImages", 'lastID': id },
							cache: true,
							success: function (response){										
									window.location.href = "index.php?mod=admin&op=adminanuncios";
									alert("Las imágenes se guardaron correctamente");																
							}
							
						});
				
			});
			
		
			//eliminar anuncio
			$('.admin-results .container-fluid .row p span').bind("click", function () {
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
            Init: init
            //View: _view
        };

    }();

})(jQuery);