function enviar_formulario()
{
    document.dates.action = "imprimir";
    document.dates.method = "GET";
    document.dates.submit();
}

    $(".mayuscula").keyup(function(){
        $(this).val( $(this).val().toUpperCase() );
    });

    if (window.history.forward(1) != null)
        window.history.forward(1);

 $(function () {
        $("#txtClave").keypress(function (e) {
            var tecla = e.keyCode || e.which;
            if (tecla == 8 || tecla == 13)
                return true; // 3
            patron = /\w/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
        });
    });
    //enviar formulario con enter
    $('#curp, #actaMatrimonio, #actaNacimiento, #actaDefuncion').keydown(function(e) {
    if (e.keyCode == 13) {
        $('#curp').submit();
        presiono();
    }
});
    //valida letras
    function permite(elEvento, permitidos) {
  // Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  //enter 13 , 8
  var teclas_especiales = [ 37, 39, 46];
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
  // Seleccionar los caracteres a partir del parámetro de la función
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
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

  function sonido(num) {
     try {        
        window.external.reproducirAudio(num);
    }catch(err) {} 
  }
  function loading_show(){
    //$(".clase_cargando").css({"visibility":"visible"});
  }
   /////////////////////////////// 
    
    function compruebacampo(evt, campotexto)
    {
        //Validar la existencia del objeto event
        evt = (evt) ? evt : event;
        //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
            //Predefinir como valido
            var respuesta = true;
            //Validar si el codigo corresponde a
            if (charCode > 31 && (charCode < 48 || charCode > 57))
            {
                //Asignar FALSE a la respuesta si es de los NO aceptables
                respuesta = false;
            }
//Valida rango valido 1-10
            if ((campotexto.value + String.fromCharCode(charCode)) > 31 || (campotexto.value + String.fromCharCode(charCode)) < 1) {
                respuesta = false;
            }
            //Regresar la respuesta
            return respuesta;
        }

function imgazul(x) {
    x.style.backgroundImage = "url(../img/btn_buscar.png)";
    
}
function imgnegra(x) {
    x.style.backgroundImage= "url(../img/btn_buscar1.png)";
    }
    
    function imgazullim(x) {
    x.style.backgroundImage = "url(../img/btn_borrar.png)";
    
}
function imgnegralim(x) {
    x.style.backgroundImage= "url(../img/btn_borrar1.png)";
    }
    
 function presiono(){  
     //$(document).ready(function(){ $(".clase_cargando").css({"visibility":"visible"});});
$(function(){ 
        //$(".clase_cargando").fadeIn(2); 
    }); }
//function justNumbers(e)
//        {
//        var keynum = window.event ? window.event.keyCode : e.which;
//        if ((keynum == 8) || (keynum == 46))
//        return true;
//         
//        return /\d/.test(String.fromCharCode(keynum));
//        };
//        function validarNro(e) 
//				{
//			var tecla = e.keyCode || e.which; 			
//			if (tecla==8||tecla==13 ||tecla==9) return true; // 3
//		 	patron = /\d/; // Solo acepta números
//			te = String.fromCharCode(tecla); // 5
//			return patron.test(te);
//			
//				};