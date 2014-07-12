
$(document).ready(function () {
    Contacto.Index.Init();
});

var Contacto = Contacto || {};
(function ($, undefined) {

    //
    Contacto.Index = function () {
        function init() {
            //_view = $('#recipe-finder');            
            initControls();
            initEvents();

        }
        function initControls() {            
            
        }

        function initEvents() {
			$("#sendEmailButton").bind("click", function(event) {
				var nombre = $("#contactForm #nombre");
				var apellido = $("#contactForm #apellido");
				var email = $("#contactForm #email");
				var tel = $("#contactForm #tel");
				var subj = $("#contactForm #subj");
				var mensaje = $("#contactForm #mensaje");
                                if(nombre.val() == "")
					nombre.addClass("required");
				else
					nombre.removeClass("required");
                                if(apellido.val() == "")
					apellido.addClass("required");
				else
					apellido.removeClass("required");
				if(email.val() == "")
					email.addClass("required");
				else
					email.removeClass("required");
				if(tel.val() == "")
					tel.addClass("required");	
				else
					tel.removeClass("required");
                                if(subj.val() == "")
					subj.addClass("required");
				else
					subj.removeClass("required");
				if(mensaje.val() == "")
					mensaje.addClass("required");	
				else
					mensaje.removeClass("required");	
                               
                                if(nombre.val() != "" && apellido.val() != "" && email.val() != "" && tel.val() != "" && subj.val() != "" && mensaje.val() != "")
                                    $("#contactForm").submit();
			});

        }
		 
		
        return {
            Init: init
            //View: _view
        };

    }();

})(jQuery);
