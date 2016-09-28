<?PHP 
$respuesta = $DatosBusqueda["respuesta"];
$propietario = $DatosBusqueda["propietario"];
$numerocontrato = $DatosBusqueda["numerocontrato"];
$sesion = $Enviados;
$domicilio = $DatosBusqueda["domicilio"];
$importetotal = $DatosBusqueda["importetotal"];
$concepto = $DatosBusqueda["concepto"];


//$respuesta = urldecode(utf8_encode($respuesta));
//$propietario = urldecode(utf8_encode($propietario));
//$domicilio = urldecode(utf8_encode($domicilio));
//$concepto = urldecode(utf8_encode($concepto));
?>
<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<div class="fondobusquedoagua">
	<div class="Labels">
		<label class="text-labels-agua laprpietario">Propietario:</label>
		<label class="text-labels-agua labnumerocontrato">Número de Contrato:</label>
		<label class="text-labels-agua labdomicilio">Domicilio:</label>
		<label class="text-labels-agua labnotainformativa">Nota Informativa:</label>
		<label class="text-labels-agua labconecpto">Concepto:</label>
		<label class="text-labels-agua latotalpago">Total a Pagar:</label>
		<!--
<label class="text-labels labult">Total a Pagar:</label>-->
	</div>
	<div class="Respuesta-agua">
		<label class="tex_Res-agua reprpietario"><?php echo $propietario ?></label><br>
		<label class="tex_Res-agua rebnumerocontrato"><?php echo $numerocontrato?></label>
		<label class="tex_Res-agua rebdomicilio"><?php echo $domicilio?></label>
		<label class="tex_Res-agua rebnotainformativa"><?php echo $respuesta ?></label>
		<label class="tex_Res-agua rebconecpto"><?php echo $concepto ?></label>
		<label class="tex_Res-agua retotalpago"><?php echo $importetotal ?></label>
	</div>
	</div>

		<?php 		
		$DatosBusqueda = json_encode($DatosBusqueda);
		$attributes = array('id' => 'frm_pago', 'name' => 'frm_pago');
		echo form_open("agua/FormaPago", $attributes);
			echo form_input(array('name'=>'sesion', 'id'=>'sesion', 'type'=>'hidden', 'value'=>$session));
			echo form_input(array('name'=>'numerocontrato', 'id'=>'numerocontrato', 'type'=>'hidden', 'value'=>$numerocontrato));
			echo form_input(array('name'=>'importetotal', 'id'=>'importetotal', 'type'=>'hidden', 'value'=>$importetotal));
			echo form_input(array('name'=>'busqueda', 'id'=>'busqueda', 'type'=>'hidden', 'value'=>$DatosBusqueda));
			echo form_input(array('name'=>'pagina', 'id'=>'pagina', 'type'=>'hidden', 'value'=>$pag));
			?>
			
				<input onclick="" name="BUSCAR" type="submit" value=""  class="btn-pagar-agua"/>
		<?php
		echo form_close();
			echo "<script type='text/javascript'>window.external.reproducirAudio('7')</script>"	;	
		?>
	
<?php 
$attributes = array('class' => 'myform', 'id' => 'myform', 'name' => 'myform');
echo form_open("agua/BusquedaDatos", $attributes);
?>
 <input type="hidden" name="sesion2"  value="<?php echo $session ?>"/>
<?php
echo form_close();
?>
<?php 
if($pag == "Datos")
{?>
<a href="javascript: submitform()" id="regresar" class="btn-regresar"></a>
<?php
}
else
{
?>
<a href="<?php echo base_url(); ?>agua" id="regresar" class="btn-regresar"/>
<?php
}
?>
<script type="text/javascript">
function submitform()
{
    document.forms["myform"].submit();
}
</script>
