
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

                               $("#contactForm input, #contactForm textarea").each(function (i,val) {
                                   if(!val.value || $(this).val().charAt(0) == " ")
                                       val.className = "required";
                                   else
                                       val.className = "";
                                });
				
                                if(!($("#contactForm input, #contactForm textarea").hasClass("required")))
                                    $("#contactForm").submit();
			}); 

        }
		 
		
        return {
            Init: init
            //View: _view
        };

    }();

})(jQuery);