
$(document).ready(function () {
    Home.Index.Init();
});

var Home = Home || {};
(function ($, undefined) {

    //
    Home.Index = function () {
        function init() {
            //_view = $('#recipe-finder');            
            initControls();
            initEvents();

        }
        function initControls() {            
            $('.carousel').carousel();
			$('#carousel-detalle').carousel();
							
			//pagination
			// var items = $(".grid-wrapper .row").children(".thumbnail-anuncio").length;			
			// if(items >= 3)
				// alert("major");
						 
			var mapOptions = {
				zoom: 16,
				center: new google.maps.LatLng(20.11906219999996,-98.73450786931153)
			}
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);			
			var kmlLayer = new google.maps.KmlLayer({
				url: 'http://www.intercolin.com/Content/maps/pachucaintercolin.kml?rand="+(new Date()).getTime()',
                                map: map,
                                preserveViewport: true
			});

			kmlLayer.setMap(map);
        }

        function initEvents() {


        }
		 
		
        return {
            Init: init
            //View: _view
        };

    }();

})(jQuery);
