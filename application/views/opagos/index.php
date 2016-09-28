<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
// echo count($session); 
// Vista
if (count($IngresosOtrospagos)==0) {
    
}
    for ($i=0; $i < count($IngresosOtrospagos); $i++) { 
        $IngresosOtrospagos[$i] = explode(",", $IngresosOtrospagos[$i]);
    }
//var_dump($IngresosOtrospagos);
?>
<div class="fondobusquedaopagos">
    <div class="Leyendaotrospagos">
        <label class="Textoleyendaotrospagos">Busca tu Adeudo a Pagar</label>
    </div>
<form action="<?php echo base_url();?>otrospagos/buscarOPagos" method="POST" id="frm_predial" class="box-otrospagos">
    <label class="text-labels">Selecciona el tipo de Pago</label><br>
    <select id='txtIngreso' name='tipoingreso'>
        <?php 
        for ($ingreso=0; $ingreso < count($IngresosOtrospagos); $ingreso++) { 
            echo "<option value=".str_replace("'clavetipo':", '', $IngresosOtrospagos[$ingreso][2]).">";
            echo str_replace(["'tipoingreso':'","'"], '', $IngresosOtrospagos[$ingreso][3])."</option>";
        }
        ?>
    </select><br><br><br>
    <label id='etiqueta1' class="text-labels"></label><br>
    <input type="text" class="txtIngreso2 soloLetras" id="" name="ingreso2" maxlength="20" value="<?php echo $Valor2; ?>" /><br><br><br>
    <label id='etiqueta2' class="text-labels"></label><br>
    <input type="text"  class="txtIngreso3 soloLetras" id="" maxlength="150" name="ingreso3" value="<?php echo $Valor3; ?>" /><br><br>
	<input type="hidden" name="sesion" value="<?php echo $session ?>"/>
	<input onclick="" name="BUSCAR" type="submit" value=""  class="btn-boton-opagos"/> 
</form>
<label class="tex_MensajeError_opagos"><?php echo $MensajeError; ?></label>
<?php
echo form_error('tipoingreso', '<div class="error-tipoingreso">', '</div>');
echo form_error('ingreso2', '<div class="error-ingreso2">', '</div>');
echo form_error('ingreso3', '<div class="error-ingreso3">', '</div>');
?>
</div>
<a href="<?php echo base_url(); ?>" id="regresar" class="btn-regresar"></a>

<input type="hidden" value="" id="seleccionado">
<script type="text/javascript">
var optionValue  = search = "<?php echo $tipoingreso; ?>";
$("#txtIngreso").val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);
</script>
<script>
$( "#txtIngreso" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).val() + " ";
        $("#seleccionado").val(str);
    });
    var clavetipoval = $("#seleccionado").val();
    if (clavetipoval==0) {
        $( "#etiqueta1" ).text("Folio/Solicitud/Infracción/Orden");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social/ Número de Placas");
    }
    else if (clavetipoval==30055) {
        $( "#etiqueta1" ).text("Folio");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social");
    }
    else if (clavetipoval==30057) {
        $( "#etiqueta1" ).text("Número de Infracción ");
        $( "#etiqueta2" ).text("Número de Placas");
    }
    else if (clavetipoval==30009) {
        $( "#etiqueta1" ).text("Solicitud");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social");
    }
    else if (clavetipoval==30004) {
        $( "#etiqueta1" ).text("Solicitud");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social");
    }
    else if (clavetipoval==30005) {
        $( "#etiqueta1" ).text("Folio");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social");
    }
    else{
        $( "#etiqueta1" ).text("Folio/Solicitud/Infracción/Orden");
        $( "#etiqueta2" ).text("Apellido Paterno o Denominación de la Razón Social/ Número de Placas");
    }
  })
  .change();
</script>

<script type="text/javascript">
	// $(".txtIngreso2").keypress(function(e) {
 //    var tecla = e.keyCode || e.which; 			
	// 		if (tecla==8||tecla==13) return true; // 3
	// 	 	patron = /^[0-9]+$/; //numeros y letras
	// 		te = String.fromCharCode(tecla); // 5
	// 		return patron.test(te);
 //    });

    $(".soloLetras").keypress(function(e){   
                cadena = $(this).val();
                cadenalength = cadena.length;
                
                var tecla = e.keyCode || e.which; 
                if(cadena === "" && tecla==32 ){return false;}
                if (tecla == 46) {return true;}                
                if(cadena.substring(cadenalength-1) === " " && tecla === 32  ){return false;}                
                
                if (tecla==8||tecla==13||tecla==32||tecla==47||tecla==44) return true; // 3
                if (tecla==32) return false; // 3
                patron = /^[a-z0-9A-ZñÑÃ Ã¨ÃˆÃŒÃ’Ã“'\s]+$/; 
                te = String.fromCharCode(tecla); // 5
                $(this).val($(this).val().toUpperCase());
                return patron.test(te);            
            });
</script>