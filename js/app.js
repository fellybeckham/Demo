 function loading_show(){
    $(".clase_cargando").css({"visibility":"visible"});
  }

function permite(elEvento, permitidos) {
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  //8,  13 = enter
  var teclas_especiales = [37, 39, 46];
  switch(permitidos) {
    case 'num':
      permitidos = numeros;
      break;
    case 'car':
      permitidos = caracteres;
      break;
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
  }
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

function compruebacampo(evt, campotexto){
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));         
	var respuesta = true;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	    respuesta = false;
	}
	if ((campotexto.value + String.fromCharCode(charCode)) > 31 || (campotexto.value + String.fromCharCode(charCode)) < 1) {
	    respuesta = false;
	}
	return respuesta;
}
 function presiono(){

 }
 
  $(function () {
        $("#txtClave").keypress(function (e) {
            var tecla = e.keyCode || e.which;
            if (tecla == 8 || tecla == 13)
                return true; // 3
            patron = /\w/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
        });
        $(".mayuscula").keyup(function(){
	        $(this).val( $(this).val().toUpperCase() );
	    });
	    $(".onlychart").keypress(function(e){
	        cadena = $(this).val();
	        cadenalength = cadena.length;     
	        var tecla = e.keyCode || e.which; 
          
	        if(cadena === "" && tecla==32 ){return false;}                
	        if(cadena.substring(cadenalength-1) === " " && tecla === 32  ){return false;}       
          
	        if (tecla==8||tecla==13||tecla==32) return true;  //enter
          
	        patron = /^[.ñÑa-zA-Z\s]+$/; 
	        te = String.fromCharCode(tecla); // 5
	        $(this).val($(this).val().toUpperCase());
	        return patron.test(te);
	    });
      
    });