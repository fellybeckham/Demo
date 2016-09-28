<div class="box-content-copias">
	<ul class="box-copias">
	    <li><a href="#" onclick ="cuantasactas(1)" onclick="" class="copia1"></a></li>
	    <li><a href="#" onclick ="cuantasactas(2)" onclick="" class="copia2"></a></li>
	    <li><a href="#" onclick ="cuantasactas(3)" onclick="" class="copia3"></a></li>
	    <li><a href="#" onclick ="cuantasactas(4)" onclick="" class="copia4"></a></li>
	    <li><a href="#" onclick ="cuantasactas(5)" onclick="" class="copia5"></a></li>
	  </ul>
</div>
	<div class="options-regresar"> 
	    <a id="regresar" href="<?php echo base_url().'defuncion/busquedaNombre' ?>" class="btn btn-regresar"></a> 
	</div>
<script type="text/javascript">

	function cuantasactas(actas){    
	 	    //window.external.reproducirAudio('1')
	    $("#cant_actas").val(actas);
	    //$("form")submit();
	 	//window.external.FoliosDisponibles(actas,'ACTAS DE DEFUNCION');
	    $( "#formcantidad" ).submit();
	};
</script>

<div class="getfrm">
	<form id="formcantidad" action="<?php echo base_url().'defuncion/pago' ?>" method="get" >
		<input name='PRECIO_ACTA' type='hidden' value='<?= $_POST["PRECIO_ACTA"] ?>' />
		<input name='DATOS_ACTA' type='hidden' value='<?= $_POST["DATOS_ACTA"] ?>' />
		<input id='cant_actas' name='cant_actas' type='hidden'  value="" />		
		<input id='comando' name='comando' type='hidden'  value="cobrar" />
        <!--<input name="btnPagar" id="btnPagar" type="submit" value="" /> -->
	</form>
</div> 