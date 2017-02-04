
$(document).ready(function () {
    Home.Index.Init();
});

var Home = Home || {};
var map;
(function ($, undefined) {

    //
    Home.Index = function () {
        function init() {        
            initControls();            
        }
        function initControls() {            
            $('.carousel').carousel();
			$('#carousel-detalle').carousel();
							
			//pagination
			// var items = $(".grid-wrapper .row").children(".thumbnail-anuncio").length;			
			
			var mapOptions = {
				zoom: 19,
				center: new google.maps.LatLng(20.119218, -98.734287),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
			};
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			var pachuca = new google.maps.LatLng(20.118930, -98.734248); //20.118930, -98.734248
			var logo = new google.maps.MarkerImage(
				"http://intercolin.com/Content/Images/icn-logo-intercolin.png",
				new google.maps.Size(50,40)				
			);
			
			var marker = new google.maps.Marker({
				position: pachuca,
				map: map,
				title: "Oficina Intercolin",
				info: "<div class='info-window'><figure><img src='http://intercolin.com/Content/Images/oficinaPachuca.png' alt='Oficina Pachuca' /><figcaption>Oficina en Pachuca</figvaption></figure><p><label>Teléfono:</label><label>2942479</label></p><p><label>Horario:</label><label>Lun-Vie - 8am a 8pm</label></p><p>Av. Francisco I Madero 501-A, Centro, Pachuca, Hidalgo, Mexico</p></div>",
				icon: logo
			});
			
			var info = new google.maps.InfoWindow({
				content: marker['info']
			});
			
			info.open(map,marker);
			
			google.maps.event.addListener(marker, "click", function(e){
				info.open(map, marker);
			});
			

			//Another office location
			//var location2 = 20.120908, -98.771993; 
			//TODO: this function will be a generic for any map instance
			CreateMap();
        }

        function CreateMap() {
        	var mapcanvas;
        	var markerLocation = new google.maps.LatLng(20.120908, -98.771993);
			var mapOptions = {
				zoom: 20,
				center: new google.maps.LatLng(20.121179, -98.771974),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
			};

			mapcanvas = new google.maps.Map(document.getElementById('map-canvas2'), mapOptions);
			var logo = new google.maps.MarkerImage(
				"http://intercolin.com/Content/Images/icn-logo-intercolin.png",
				new google.maps.Size(50,40)				
			);
			
			var marker = new google.maps.Marker({
				position: markerLocation,
				map: mapcanvas,
				title: "Intercolin Parque de Poblamiento",
				info: "<div class='info-window'><figure><img src='http://intercolin.com/Content/Images/intercolinParquePoblamiento.jpg' alt='Intercolin parque del poblammiento' /><figcaption>Parque de Poblamiento</figcaption></figure><p><label>Teléfono:</label><label>2942479</label></p><p><label>Horario:</label><label>Lun-Vie - 8am a 8pm</label></p><p>Calle Ferrocarril Hidalgo 201, Parque de Poblamiento 1ra sección, Pachuca, Hidalgo, Mexico</p></div>",
				icon: logo
			});

			var info = new google.maps.InfoWindow({
				content: marker['info']
			});
			
			info.open(map,marker);
			
			google.maps.event.addListener(marker, "click", function(e){
				info.open(map, marker);
			});
        }
		 
		
        return {
            Init: init
            //View: _view
        };

    }();

})(jQuery);
