function show_busqueda(){
	$("#busqueda").toggle();
}
// MOSTRAR BLOQUE PARA INICIO DE SESION
function mostrar_ingreso(){

    $('#form_ingreso').width($('#welcome').width());
    $('#form_ingreso').slideToggle("slow" );
	// $("#form_ingreso").toggle();
}
function mostrar_ingreso_m(){

    $('#form_ingreso_m').slideToggle("slow" );
	// $("#form_ingreso_m").toggle();
}
// FIN

// MOSTRAR BLOQUE PARA REGISTRARSE

function desplegar_registro () {

   $('#form_registrarse').slideToggle("slow" );

}
function desplegar_registro_movil () {

   $('#form_registrarse_m').slideToggle("slow" );

}

// FIN 

function show_tool(){
	// $("#micuenta").toggle();
    $('.desplegable').width($('#tool').width());
    $('#micuenta').slideToggle("fast" );
}



function actualizarFavorito(elemento   ,    url ){

	$("#modalContent").block({ message: "cargando" });
	$.post( url  , function(response){
		$("#modalContent").html( response );
		$("#modalContent").unblock();
	});
	$(elemento).toggleClass('active');
	$(elemento).find('.icono-estrella').toggleClass('icono-estrella-activo');
}

function centrarVert(elemento){
    altura1=elemento.parent().height();
    altura2=elemento.height();
    if (altura1>=altura2) {
        elemento.css("margin-top",(altura1/2)-(altura2/2)+"px");

    }else{
        elemento.css("margin-top","20px");
    };
}



    $(document).ready(function () {
    $('#subFormtest').on('click', function(){aButtonPressed();});

    // Support for AJAX loaded modal window.
    // Focuses on first input textbox after it loads the window.

    // $('.lateral').height($('.menuizq').height());

    var alto= $(".menuizq").parent().height();

    $(".menuizq").height(alto);


    // CENTRAR CONTENIDO VERTICALMENTE
    $('.contenedor-centrar').each(function () {
       centrarVert($(this));
   });
    /*
    funcion que encarga de mostrar el pill en modal box 
    */
    $('[data-toggle="modal"]').click(function (e) {
        $("#modalContent").block({
            message: "cargando"
        });
        e.preventDefault();
        var url = $(this).attr('href');        
        $.get(url, function (data) {
            $("#modalContent").html(data);
            $("#modalContent").unblock();

        });
    });

	/*
    funcion que muestra el hover encima de los pill
    */
    $('.img-pill').hover(
        function () {
            $(this).find('.captionpill').stop(true, true).fadeIn(250);
        },
        function () {
            $(this).find('.captionpill').stop(true, true).fadeOut(250);
        }
        );
});


function  actualizarVotacion(    url  ){

    $("#votaciones").load(  url  );
}