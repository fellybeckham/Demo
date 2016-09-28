<?PHP 
// var_dump($DatosBusqueda);
//echo "<br>";
// $DatosBusqueda = urldecode($DatosBusqueda);
// $quitarcaracteres =      array('{', '[', ']', '}', ',\'');
// $remplazadocaracteres =  array('' , '' , '' , '', '*');
// $limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $DatosBusqueda);
// $porciones = explode("*", $limpio);
// echo "<pre>";
// var_dump($DatosBusqueda);
// echo "</pre>";

//variables
$Concepto = str_replace(["concepto':'","'"], "", $DatosBusqueda[2]);
$nota = str_replace(["nota':'","'"], "", $DatosBusqueda[3]);
$propietario = str_replace(["propietario':'","'"], "", $DatosBusqueda[4]);
$ubicacion = str_replace(["ubicacion':'","'"], "", $DatosBusqueda[5]);
$domicilio = str_replace(["domicilio':'","'"], "", $DatosBusqueda[6]);
$totaladeudo = str_replace(["totaladeudo':'","'"], "", $DatosBusqueda[7]);
$noprop = str_replace(["noprop':'","'"], "", $DatosBusqueda[8]);
$genero = str_replace(["genero':'","'"], "", $DatosBusqueda[9]);
$conceptos = str_replace(["conceptos':'","'"], "", $DatosBusqueda[10]);
$rfc = str_replace(["rfc':'","'"], "", $DatosBusqueda[11]);


$lista = explode('|', $conceptos);

?>
<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<div class="fondobusquedo">
	<div class="Labels">
		<label class="text-labels label-tipoAdeudo">Tipo de Adeudo:</label>
		<label class="text-labels label-contribuyente">Contribuyente:</label>
		<label class="text-labels label-rfc">RFC:</label>
		<label class="text-labels label-ubicacion">Ubicación:</label>
		<label class="text-labels label-domicilio">Domicilio Fiscal:</label>
		<label class="text-labels label-observaciones">Observaciones:</label>
		<!-- <label class="text-labels label-conceptos">Conceptos:</label> -->
		<label class="text-labels label-total">Total:</label>
	</div>
	<div class="Respuesta">
		<label class="tex_Resopagos label-Respuesta1"><?php  echo $Concepto?></label><br>
		<label class="tex_Resopagos label-Respuesta2"><?php  echo $propietario ?></label>
		<label class="tex_Resopagos label-Respuesta3"><?php  echo $rfc ?></label>
		<label class="tex_Resopagos label-Respuesta4"><?php  echo $ubicacion ?></label>
		<label class="tex_Resopagos label-Respuesta5"><?php  echo $domicilio ?></label>
		<label class="tex_Resopagos label-Respuesta6"><?php  echo $nota ?></label>
		<!-- <label class="tex_Resopagos label-Respuesta7"><?php  //echo $conceptos ?></label> -->
		<label class="tex_Res label-Respuesta8">$ <?php  $totaladeudo = str_replace(',', '', $totaladeudo); echo number_format($totaladeudo, 2, '.', ',') ?></label>
	</div>
	<div class="Respuesta2"></div>
	<div class="outer">
		<div class="innera">
			<table class="tg">
				<thead>
					<tr class="sincolor">
						<th class="noweight"><label class="text-labels colormorado">Conceptos:</label></th><!-- label-conceptos -->
					</tr>
				</thead>
				<tbody>
						<?php 
						foreach ($lista as $value) {
							echo "<tr><th  class='noweight textalingright'><label class='tex_Res2'>".$value."</label></th></tr>";
						}
						?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="RespuestaButton">
		<?php 
		if ($totaladeudo==".00") {
			echo '<a href="'.base_url().'predial" class="btn-SinPago"></a>';
			echo "<script type='text/javascript'>window.external.reproducirAudio('5')</script>";
		}
		else {
			echo '<form id="formpago" action="'.base_url().'otrospagos/pago" method="post">
				<input name="tipoingreso" type="hidden" value="'.$tipoingreso.'" >
				<input name="ingreso2" type="hidden" value="'.$Valor2.'" >
				<input name="ingreso3" type="hidden" value="'.$Valor3.'" >
				<input name="sesion" type="hidden" value="'.$Enviados.'" >
				<input name="montoadeudo" type="hidden" value="'.$totaladeudo.'" >
				<input onclick="" name="BUSCAR" type="submit" value=""  class="btn-pagar-opagos"/>
				</form>';
			echo "<script type='text/javascript'>window.external.reproducirAudio('7')</script>";
		}
					
		?>
	</div>
	
</div>

<a href="<?php echo base_url(); ?>otrospagos" id="regresar" class="btn-regresar"/>