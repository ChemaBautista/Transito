jQuery(document).ready(function(){
	jQuery(".custom_chb").mousedown(function() {
		changeCheck(jQuery(this));
	});
	jQuery(".custom_chb_wrapper label").click(function() {
		changeCheck(jQuery(this).parent('.custom_chb_wrapper').children('.custom_chb'));
	});
	jQuery(".custom_chb").each(function() {
	    changeCheckStart(jQuery(this));
	});
});
function changeCheck(el){
	var el = el,input = el.find("input").eq(0);
	if(!input.attr("checked")) {
		el.addClass("active");   
		input.attr("checked", true);
	} 
	else {
		el.removeClass("active"); 
		input.attr("checked", false)
	}
	return true;
}
function changeCheckStart(el){
	var el = el, input = el.find("input").eq(0);
	if(input.attr("checked")) {
		el.addClass("active");   
	}
	return true;
}

//observaciones
$(document).ready(function(){
	$('#obse').change(function(){
		if(this.checked)
			$('#obser').fadeIn('fast');
		else{
			$('#obser').fadeOut('fast');
			document.getElementById("obser").value = "";
		}
	});
});

//otros servicios
$(document).ready(function(){
	$('#otros').change(function(){
		if(this.checked)
			$('#otros_service').fadeIn('fast');
		else{
			$('#otros_service').fadeOut('fast');
			document.getElementById("otros_service").value = "";
		}
	});
});

//div bujias
$(document).ready(function(){
	$('#change_bujia').change(function(){
		if(this.checked)
			$('#div_bujias').fadeIn('fast');
		else{
			$('#div_bujias').fadeOut('fast');
			document.getElementById("tipo_bujia").value = "";
		}
	});
});

//div birlos
$(document).ready(function(){
	$('#birlos_seguridad').change(function(){
		if(this.checked)
			$('#div_birlos').fadeIn('fast');
		else{
			$('#div_birlos').fadeOut('fast');
			$( "#birlo_si" ).prop( "checked", false );
			$( "#birlo_no" ).prop( "checked", false );
		}
	});
});

//cambio de aceite
$(document).ready(function(){
	$('#change_aceite').change(function(){
		if(this.checked)
			$('#prueba').fadeIn('fast');
		else{
			$('#prueba').fadeOut('fast');
			$( "#aire_radio" ).prop( "checked", false );
			$( "#aceite_radio" ).prop( "checked", false );
			$( "#gasolina_radio" ).prop( "checked", false );
			$( "#cabina_radio" ).prop( "checked", false );
			$( "#sinte" ).prop( "checked", false );
			$( "#semi" ).prop( "checked", false );
			$( "#mine" ).prop( "checked", false );
			document.getElementById("marca_a").value = "";
			document.getElementById("viscosidad").value = "";
			document.getElementById("input_aceite").value = "";
			document.getElementById("input_aire").value = "";
			document.getElementById("input_gasolina").value = "";
			document.getElementById("input_cabina").value = "";
			document.getElementById("input_aceite").readOnly = true;
			document.getElementById("input_aire").readOnly = true;
			document.getElementById("input_gasolina").readOnly = true;
			document.getElementById("input_cabina").readOnly = true;
		}
	});
});

//filtro aceite
$(document).ready(function(){
	$('#aceite_radio').change(function(){
		if(this.checked){
			document.getElementById("input_aceite").readOnly = false;
		}
		else{
			document.getElementById("input_aceite").readOnly = true;
			document.getElementById("input_aceite").value = "";
		}
	});
});

//cambio de balatas delanteras
$(document).ready(function(){
	$('#cambio_balatas_delan').change(function(){
		if(this.checked)
			$('#delanteras').fadeIn('fast');
		else{
			$('#delanteras').fadeOut('fast');
			document.getElementById("delanteras").value = "";
		}
	});
});

//cambio de balatas traseras
$(document).ready(function(){
	$('#cambio_balatas_tra').change(function(){
		if(this.checked)
			$('#traseras').fadeIn('fast');
		else{
			$('#traseras').fadeOut('fast');
			document.getElementById("traseras").value = "";
		}
	});
});

//cambio de liquido de frenos
$(document).ready(function(){
	$('#cambio_liquido_frenos').change(function(){
		if(this.checked)
			$('#liq_frenos').fadeIn('fast');
		else{
			$('#liq_frenos').fadeOut('fast');
			document.getElementById("liq_frenos").value = "";
		}
	});
});

//revision de acumulador
$(document).ready(function(){
	$('#revision_acumulador').change(function(){
		if(this.checked)
			$('#rev_acum').fadeIn('fast');
		else{
			$('#rev_acum').fadeOut('fast');
			document.getElementById("rev_acum").value = "";
		}
	});
});

//cambio de acumulador
$(document).ready(function(){
	$('#cambio_acumulador').change(function(){
		if(this.checked)
			$('#cambio_acum').fadeIn('fast');
		else{
			$('#cambio_acum').fadeOut('fast');
			document.getElementById("cambio_acum").value = "";
		}
	});
});

//filtro aire
$(document).ready(function(){
	$('#aire_radio').change(function(){
		if(this.checked){
			document.getElementById("input_aire").readOnly = false;
		}
		else{
			document.getElementById("input_aire").value = "";
			document.getElementById("input_aire").readOnly = true;
		}
	});
});

//filtro gasolina
$(document).ready(function(){
	$('#gasolina_radio').change(function(){
		if(this.checked){
			document.getElementById("input_gasolina").readOnly = false;
		}
		else{
			document.getElementById("input_gasolina").value = "";
			document.getElementById("input_gasolina").readOnly = true;
		}
	});
});

//filtro cabina
$(document).ready(function(){
	$('#cabina_radio').change(function(){
		if(this.checked){
			document.getElementById("input_cabina").readOnly = false;
		}
		else{
			document.getElementById("input_cabina").value = "";
			document.getElementById("input_cabina").readOnly = true;
		}
	});
});

//reset de formulario
function resetform() 
{
	document.getElementById("myForm").reset();
	$('#otros_service').fadeOut('fast');
	$('#obser').fadeOut('fast');
	$('#prueba').fadeOut('fast');
}

//Limpieza de inyectores
$(document).ready(function(){
	$('#limpieza_inyectores').change(function(){
		if(this.checked)
			$('#limpieza_inyec').fadeIn('fast');
		else{
			$('#limpieza_inyec').fadeOut('fast');
			$( "#4" ).prop( "checked", false );
			$( "#5" ).prop( "checked", false );
			$( "#6" ).prop( "checked", false );
			$( "#8" ).prop( "checked", false );
		}
	});
});

//Rectificado de discos
$(document).ready(function(){
	$('#rectificado_discos').change(function(){
		if(this.checked)
			$('#recti_disco').fadeIn('fast');
		else{
			$('#recti_disco').fadeOut('fast');
			$( "#1r" ).prop( "checked", false );
			$( "#2r" ).prop( "checked", false );
			$( "#3r" ).prop( "checked", false );
			$( "#4r" ).prop( "checked", false );
		}
	});
});
