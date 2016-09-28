$(document).ready(function(){
	//Touch
	 $('.hover').bind('touchstart touchend', function(e) {
        e.preventDefault();
        $(this).toggleClass('hover_effect');
    });
	$(".btnpagar").hide();
	$("#fondo").hide();
	$("#mascopias").hide();
		
/*::::::::::::::::::::::::::::VALIDACIONES::::::::::::::::::::::::::::*/
	var globalVal = 0;
	$("#nom").bind({
		blur: function(){
    	$(this).val($(this).val().toUpperCase());
				var nom = $("#nom").val();
				if(nom==""){
					$("#nom").css("background-color","#FFE4E1");
					globalVal++;
					//alert("nom: "+globalVal);
				}else{
					$("#nom").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("nom: "+globalVal);
				}
		}
	});
	$("#apa").bind({
		blur: function(){
    	$(this).val($(this).val().toUpperCase());
				var apa = $("#apa").val();
				if(apa==""){
					$("#apa").css("background-color","#FFE4E1");
					globalVal++;
					//alert("apa: "+globalVal);
				}else{
					$("#apa").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("apa: "+globalVal);
				}
		}
	});
	$("#ama").bind({
		blur: function(){
    	$(this).val($(this).val().toUpperCase());
		}
	});
	$("#dia").bind({
		blur: function(){
			var val = this.value = this.value.replace(/[^0-9]/g,'');
			var val = this.value = this.value.replace(/[0-9]\d{2}/g,'');
			//alert(val);
			if(val>31){
				//alert("entra");
				this.value = this.value.replace(val,'');
			}
				var dia = $("#dia").val();
				if(dia==""){
					$("#dia").css("background-color","#FFE4E1");
					globalVal++;
					//alert("dia: "+globalVal);
				}else{
					$("#dia").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("dia: "+globalVal);
				}
		}
	});
	$("#mes").bind({
		change: function(){
				var mes = $("#mes").val();
				if(mes==""){
					$("#mes").css("background-color","#FFE4E1");
					globalVal++;
					//alert("mes: "+globalVal);
				}else{
					$("#mes").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("mes: "+globalVal);
				}
		}
	});
	$("#ano").bind({
		blur: function(){
			var val = this.value = this.value.replace(/[^0-9]/g,'');
			var val = this.value = this.value.replace(/[0-9]\d{4}/g,'');
				var ano = $("#ano").val();
				if(ano==""){
					$("#ano").css("background-color","#FFE4E1");
					globalVal++;
					//alert("ano: "+globalVal);
				}else{
					$("#ano").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("ano: "+globalVal);
				}
		}
	});
	$("#sex").bind({
		blur: function(){
				var sex = $("#sex").val();
				if(sex==""){
					$("#sex").css("background-color","#FFE4E1");
					globalVal++;
					//alert("sex: "+globalVal);
				}else{
					$("#sex").removeAttr("style");
					if(globalVal!=0){
						globalVal--;
					}
					//alert("sex: "+globalVal);
				}
		}
	});
	/*$("#mes").click(function(){
		$("#mes").css("background-color","#FFF");
	});*/
	$("#mes").change(function(){
		mes = $("#mes option:selected").attr("value");
			if(mes==0){
				$("#mes").css("background-color","#FFE4E1");
				globalVal++;
				//alert("mes: "+globalVal);
			}else{
				$("#mes").removeAttr("style");
				if(globalVal!=0){
					globalVal--;
				}
				//alert("mes: "+globalVal);
			}
	});
	$("#sex").change(function(){
		sex = $("#sex option:selected").attr("value");
			if(sex==0){
				$("#sex").css("background-color","#FFE4E1");
				globalVal++;
				//alert("mes: "+globalVal);
			}else{
				$("#sex").removeAttr("style");
				if(globalVal!=0){
					globalVal--;
				}
				//alert("mes: "+globalVal);
			}
	});
	/*:::::::::::::::::::::::::::::::::::BOTONES DE BUSQUEDA DE FORMULARIOS::::::::::::::::::::::::::::*/
	$(".buscar").click(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/buscarOn.png)");
		var nom = $("#nom").val();
		var apa = $("#apa").val();
		var ama = $("#ama").val();
		var dia = $("#dia").val();
		//var mes = $("#mes").val();
		var mes = $("#mes option:selected").attr("value");
		var ano = $("#ano").val();
		var sex = $("#sex option:selected").attr("value");
		var importe = $(".importe").html();
		
		//alert(importe);
		//var sex = $("#sex").val();
		//alert(nom+" | "+apa+" | "+ama+" | "+dia+" | "+mes+" | "+ano+" | "+sex);
		
		globalVal = 0;
		if(nom==""){
			$("#nom").css("background-color","#FFE4E1");
			globalVal++;
		}else{
			if(globalVal!=0){
				globalVal--;
			}
		}if(apa==""){
			//alert("Entró");
			$("#apa").css("background-color","#FFE4E1");
			globalVal++;
			//alert(globalVal);
		}else{
			//alert("Entró a Else");
			if(globalVal!=0){
				globalVal--;
			}
		}if(dia==""){
			$("#dia").css("background-color","#FFE4E1");
			globalVal++;
		}else{
			if(globalVal!=0){
				globalVal--;
			}
		}if(mes==0){
			$("#mes").css("background-color","#FFE4E1");
			globalVal++;
		}else{
			if(globalVal!=0){
				globalVal--;
			}
		}if(ano==""){
			$("#ano").css("background-color","#FFE4E1");
			globalVal++;
		}else{
			if(globalVal!=0){
				globalVal--;
			}
		}if(sex==0){
			$("#sex").css("background-color","#FFE4E1");
			globalVal++;
		}else{
			if(globalVal!=0){
				globalVal--;
			}
		}
		//alert(globalVal);
		
		if (globalVal==0 && (nom!="" && apa!="" && dia!="" && mes!=0 && ano!="" && sex!=0)){ //Si no hay valores vacios en el Formulario
			$(".btnpagar").removeAttr("style");
			$(".btnpagar").hide();
			$(".verificarText").removeAttr("style");
			//$("#formulario1").submit();
			$.ajax({
				type: "POST",
				url:  "verificarActaMat.php",
				data: "nombre="+nom+"&apaterno="+apa+"&amaterno="+ama+"&dia="+dia+"&mes="+mes+"&ano="+ano+"&sexo="+sex+"&importe="+importe,
				beforeSend: function(){
					$(".busqueda").html('<h3>Cargando datos ...</h3>').show();
				},            
				success: function(datos){
					$(".buscar").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/buscarOff.png)");
					alert(datos);
					var res =  datos.split(',');
					//alert(res[1]);
					var a = res[1];
					if(a = true){//Si viene la bandera activa de error, solo muestro ACTA NO ENCONTRADA
						$(".busqueda").html("").hide();
						$(".busqueda").html(res[0]).show();
						$(".btnpagar").hide();
					}else{//Si no, concateno el resultado y aparezco el boton pagar
						$(".btnpagar").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/pagarOff.png)");
						$(".verificarText").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/verificarText.png)");
						$(".busqueda").html("").hide();
						$(".busqueda").html(datos).show();
					}
				}
			});//fin de AJAX*/	
		}else{
			$(".btnpagar").hide();
			$(".busqueda").html('<div id="vacios"><h3>Existen campos vacios...</h3></div>').show();
			$(".buscar").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/buscarOff.png)");
		}
	});
	
	/*::::::::::::::: BOTON PAGAR :::::::::::::::::::::*/
	$(".btnpagar").click(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/pagarOn.png)");
		var pref = $("#conyuge_prefijo").val();
		var nomb = $("#nombre").val();
		var apat = $("#primer_apellido").val();
		var amat = $("#segundo_apellido").val();
		var freg = $("#fecha_reg").val();
		var crip = $("#crip").val();
		var curp = $("#curp").val();
		$("#formulario1").submit();
		//alert(pref+" | "+nomb+" | "+apat+" | "+amat+" | "+freg+" | "+crip+" | "+curp);
		/*$.ajax({
			type: "POST",
			url:  "hola.php",
			data: "",
			beforeSend: function(){
				$(".formNombre").html('<h3>Cargando datos ...</h3>').show();
			},            
			success: function(datos){
				alert(datos);
				$(".formNombre").html("");
				$(".formNombre").html(datos).show();
				$(".formOpciones").hide();
				//$(".formNombre").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/fondoo_tpagos.png");
				$(".formNombre").css("margin-left","110px");
			}
		});//fin de AJAX*/
		/*$.ajax({
			type: "POST",
			url:  "cargarCopias.php",
			data: "pref="+pref+"&nom="+nomb+"&apa="+apat+"&ama="+amat+"&freg="+freg+"&crip="+crip+"&curp="+curp,
			beforeSend: function(){
				$(".formNombre").html('<h3>Cargando datos ...</h3>').show();
			},            
			success: function(datos){
				alert(datos);
				$(".formNombre").html("");
				$(".formNombre").html(datos).show();
				$(".formOpciones").hide();
				$(".formNombre").css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/fondo_tpagos.png");
				$(".formNombre").css("margin-left","110px");
			}
		});//fin de AJAX*/	
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/buscarNombre/pagarOff.png)");
	});
	
	
	/*::::::::::::::::::::::::::::::SECCION PARA CLICKS DE NUMERO DE IMPRESIONES:::::::::::::::::::::::::::::::::::::*/
	$(".copia1").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/1copiaOn.png)");
		/*var pref = $("#conyuge_prefijo").val();
		var nomb = $("#nombre").val();
		var apat = $("#primer_apellido").val();
		var amat = $("#segundo_apellido").val();
		var freg = $("#fecha_reg").val();
		var crip = $("#crip").val();
		var curp = $("#curp").val();
		var nocopias = 1;*/
		$("#numcopias").val("1");
		$("#fCopias").submit();
		//alert(pref+" | "+nomb+" | "+apat+" | "+amat+" | "+freg+" | "+crip+" | "+curp);
	/*$.ajax({
			type: "POST",
			url:  "cargarTipoPago.php",
			data: "nom="+nomb+"&apa="+apat+"&ama="+amat+"&freg="+freg+"&crip="+crip+"&curp="+curp+"&pref="+pref+"&nocopias="+nocopias,
			beforeSend: function(){
				$(".formCopias").html('<h3>Cargando datos ...</h3>').show();
			},            
			success: function(datos){
				$(".formCopias").html("");
				$(".formCopias").html(datos).show();
			}
		});//fin de AJAX*/	
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/1copia.png)");
	});
	
	$(".copia2").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/2copiasOn.png)");
		$("#numcopias").val("2");
		$("#fCopias").submit();
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/2copias.png)");
	});
	
	$(".copia3").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/3copiasOn.png)");
		$("#numcopias").val("3");
		$("#fCopias").submit();
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/3copias.png)");
	});
	
	
	$(".copia4").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/4copiasOn.png)");
		$("#numcopias").val("4");
		$("#fCopias").submit();
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/4copias.png)");
	});
	
	$(".copia5").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/5copiasOn.png)");
		$("#numcopias").val("5");
		$("#fCopias").submit();
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/5copias.png)");
	});
	
	$(".copias5").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/+5copiasOn.png)");
		/*$("#numcopias").val("+5");
		$("#fCopias").submit();*/
		//$("#fondo").fadeIn("500");
		$("#vCopias").val("");
		$("#fondo").fadeTo("show",.80);
		$("#mascopias").fadeIn("500");
		
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/numeroCopias/+5copias.png)");
	});
	
	$("#vCopias").blur(function(){ 
			var val = this.value = this.value.replace(/[^0-9]/g,'');
			var val = this.value = this.value.replace(/[0-9]\d{2}/g,'');
			if(val==""){
				//this.value = this.value.replace(val,'');
				$("#vCopias").val("");
				$("#vCopias").css("background-color","#FFE4E1");
			}else{
				$("#vCopias").removeAttr("style");
				}
	});
	$("#accept").click(function(){ 
		val = $("#vCopias").val();
			if(val<=99 && val!=""){
				$("#numcopias").val(val);
				$("#fondo").fadeOut("500");
				$("#mascopias").fadeOut("500");
				$("#fCopias").submit();
			}else{
				$("#vCopias").css("background-color","#FFE4E1");
			}
	});
	$("#cancel").click(function(){
		$("#fondo").fadeOut("500");
		$("#mascopias").fadeOut("500");
	});
	$("#fondo").click(function(){
		$("#fondo").fadeOut("500");
		$("#mascopias").fadeOut("500");
	});
/*:::::::::::::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::CLICK DE LOS PAGOS:::::::::::::::::::::*/
$(".pagoTarjeta").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/tarjetaOn.png)");
		var pref = $("#conyuge_prefijo").val();
		var nomb = $("#nombre").val();
		var apat = $("#primer_apellido").val();
		var amat = $("#segundo_apellido").val();
		var freg = $("#fecha_reg").val();
		var crip = $("#crip").val();
		//var curp = $("#curp").val();
		var nocopias = $("#numcopias").val();
		var importe = $("#importe").val();
		var tpago = "T";
		//alert(pref+" | "+nomb+" | "+apat+" | "+amat+" | "+freg+" | "+nocopias+" | "+curp+" | "+importe);
		var url;
		url = "vendingcobrar_Mat.php?nombre="+nomb+"&primer_apellido="+apat+"&segundo_apellido="+amat+"&fecha_reg="+freg+"&nocopias="+nocopias+"&conyuge_prefijo="+pref+"&tpago="+tpago;
		window.open(url,"_self");
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/tarjetaOff.png)");
	});
	
	$(".pagoEfectivo").mousedown(function(){
	$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/efectivoOn.png)");
		var pref = $("#conyuge_prefijo").val();
		var nomb = $("#nombre").val();
		var apat = $("#primer_apellido").val();
		var amat = $("#segundo_apellido").val();
		var freg = $("#fecha_reg").val();
		var crip = $("#crip").val();
		//var curp = $("#curp").val();
		var nocopias = $("#numcopias").val();
		var importe = $("#importe").val();
		var tpago = "E";
		//alert(pref+" | "+nomb+" | "+apat+" | "+amat+" | "+freg+" | "+nocopias+" | "+curp+" | "+importe);
		var url;
		url = "vendingcobrar_Mat.php?nombre="+nomb+"&primer_apellido="+apat+"&segundo_apellido="+amat+"&fecha_reg="+freg+"&nocopias="+nocopias+"&conyuge_prefijo="+pref+"&tpago="+tpago;
		window.open(url,"_self");	
	}).mouseup(function(){
		$(this).css("background-image","url(../Imagenes/SubMEnuRegistro%20Civil/Registro_Civil/tipoPago/efectivoOff.png)");
	});
	
	$("#backPayment").click(function(){
			$("#fPago").submit();
	});
	
});
