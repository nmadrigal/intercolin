// $(document).ready(function () {
    // InmuebleDetail.Index.Init();
// });

var InmuebleDetail = InmuebleDetail || {};
var map;
(function ($, undefined) {

    //
    InmuebleDetail.Index = function () {
        function init() {        
            initControls();
            initEvents();
        }
        function initControls() {            
           
	    }
		function mapDetail(lat,lng){   
			var mapOptions = {
				zoom: 19,
				center: new google.maps.LatLng(lat,lng),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById('map-canvas-inmueble'), mapOptions);						
			//var pachuca = new google.maps.LatLng(20.118930, -98.734248); //20.118930, -98.734248
			var markerLocation = new google.maps.LatLng(lat,lng);
			var logo = new google.maps.MarkerImage(
				"http://intercolin.com/Content/Images/icn-logo-intercolin.png",
				new google.maps.Size(50,40)				
			);
			
			var marker = new google.maps.Marker({
				position: markerLocation,
				map: map,
				title: "Inmueble",
				info: "<div class='info-window'><p>Vende: INTERCOLIN</p></div>"
				//icon: logo
			});
			
			var info = new google.maps.InfoWindow({
				content: marker['info']
			});
			
			info.open(map,marker);
			
			google.maps.event.addListener(marker, "click", function(e){
				info.open(map, marker);
			});
			
        }

        function initEvents() {


        }
		 
		
        return {
            Init: init,
			InitMapInmuebleDetail: mapDetail
            //View: _view
        };

    }();

})(jQuery);
