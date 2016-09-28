<script>  setTimeout ("window.external.regresarInicio()",60000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

?>
<div class="fondobusqueda">
<form action="<?php echo base_url();?>predial/buscarPredial" method="POST" id="frm_predial" class="box-predial">
	<!-- <input class="txtLocPredio" name="LocPredio" id="LocPredio" maxlength="5" value="<?php //echo $localizacion  ?>"/><br> -->
    <select class='txtLocPredio' id='LocPredio' name='LocPredio'>
    <?php 
        foreach ($Oficinas as $value) {
            //cadena
            $cadena = $value;
            //nueva cadena sin clave:
            $newvalueOfi = str_replace("clave:","",$cadena);
            //posicion para texto
            $pos = strpos($cadena, ',', 1); // $pos = 10
            //posicion para value
            $valueOfi = strpos($newvalueOfi, ',', 0); // $pos = 10;   
            echo "<option value=".substr($newvalueOfi, 0, $valueOfi).">";
            echo substr($cadena, $pos+9)."</option>";
        }
    ?>
    </select>
    <br>
    <select class='txtTipPredio' id='TipPredio' name='TipPredio'>
        <option value=""></option>
        <option value="1">1-URBANO</option>
        <option value="2">2-RÚSTICO</option>
    </select>
    <br>
	<!-- <input class="txtTipPredio" name="TipPredio" id="TipPredio" maxlength="5" value="<?php //echo $tipo  ?>"/><br> -->
    
	<input class="txtNumPredio" name="NumPredio" id="NumPredio" maxlength="7" value="<?php echo $Numero ?>"/><br>
	<input class="txtApellido soloLetras" name="Apellido" maxlength="120" id="Apellido" style="text-transform: uppercase" value="<?php echo  $Apellido ?>"/>
	<input type="hidden" name="sesion" value="<?php echo $session ?>"/>
	<input onclick="" name="BUSCAR" type="submit" value=""  class="btn-buscar"/> 
</form>
<label class="tex_MensajeError"><?php echo $MensajeError; ?></label>
<?php
echo form_error('LocPredio', '<div class="error-locPredio">', '</div>');
echo form_error('TipPredio', '<div class="error-tipPredio">', '</div>');
echo form_error('NumPredio', '<div class="error-numPredio">', '</div>');
echo form_error('Apellido', '<div class="error-apellido">', '</div>');
?>
</div>
<a href="<?php echo base_url(); ?>" id="regresar" class="btn-regresar"></a>

<script type="text/javascript">
var optionValue  = search = "<?php echo $localizacion; ?>"
var optionValue2 = search = "<?php echo $tipo; ?>"
$("#LocPredio").val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);
$("#TipPredio").val(optionValue2).find("option[value=" + optionValue2 +"]").attr('selected', true);
// $('#LocPredio option:contains('+search+')').prop('selected',true);  
</script>

<script type="text/javascript">
	$("#LocPredio, #TipPredio, #NumPredio").keypress(function(e) {
    var tecla = e.keyCode || e.which; 			
			if (tecla==8||tecla==13) return true; // 3
		 	patron = /^[0-9]+$/; //numeros y letras
			te = String.fromCharCode(tecla); // 5
			return patron.test(te);
    });

    $(".soloLetras").keypress(function(e){   
                cadena = $(this).val();
                cadenalength = cadena.length;
                
                var tecla = e.keyCode || e.which; 
                if(cadena === "" && tecla==32 ){return false;}
                if (tecla == 46) {return true;}                
                if(cadena.substring(cadenalength-1) === " " && tecla === 32  ){return false;}                
                
                if (tecla==8||tecla==13||tecla==32) return true; // 3
                if (tecla==32) return false; // 3
                patron = /^[a-zA-ZñÑÃ¡Ã©Ã­Ã³ÃºÃ Ã¨Ã¬Ã²Ã¹Ã€ÃˆÃŒÃ’Ã™Ã?Ã‰Ã?Ã“ÃšÃ±Ã‘Ã¼Ãœ'_\s]+$/; 
                te = String.fromCharCode(tecla); // 5
                $(this).val($(this).val().toUpperCase());
                return patron.test(te);            
            });
</script>