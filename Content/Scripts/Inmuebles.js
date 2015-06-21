
$(document).ready(function () {
    Inmuebles.Index.Init();
});

var Inmuebles = Inmuebles || {};
(function ($, undefined) {

    var _view;
    Inmuebles.Index = function () {
        function init() {
           _view = $('.grid-results');            
            initControls();
            initEvents();
        }
        function initControls() {            
            _view.find(".user-control figure").bind("click", function (event) {
                 var tipoInmueble = $(this).attr("id");
                 //if(tipoInmueble == "tipoCasas")
                   //alert("casa");
                 //if(tipoInmueble == "tipoTerreno")
                   //alert("terreno");
                 window.location.href = "index.php?mod=home&op=ventaByType&tipoInmueble=" + tipoInmueble;
            });     
        }

        function initEvents() {


        }
		 
		
        return {
            Init: init
            //View: _view
        };

    }();

})(jQuery);