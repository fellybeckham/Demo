<?PHP 
//var_dump($DatosBusqueda);
//echo "<br>";
// $quitarcaracteres =      array('{', '"' , ':', ',', '}');
// $remplazadocaracteres =  array('/', ''  , '/', '/', '' );
// $limpio = str_replace($quitarcaracteres, $remplazadocaracteres, $DatosBusqueda);
// $porciones = explode("/", $limpio);
// var_dump ($Enviados); 
//var_dump($DatosBusqueda);
$oficina = str_replace("oficina':","",$DatosBusqueda[2]);
$tipo = str_replace("tipopredio':","",$DatosBusqueda[3]);
$numpredio = str_replace("numpredio':","",$DatosBusqueda[4]);
$sesion = $Enviados;
$CuentaPredial = $oficina."-".$tipo."-".$numpredio;
$Propietario = str_replace(["propietario':'","'"], "", $DatosBusqueda[5]);
$Ubicacion = str_replace(["ubicacion':'","'"], "", $DatosBusqueda[6]);
$Domicilio = str_replace(["domicilio':'","'"], "", $DatosBusqueda[7]);
$concepto1 = str_replace(["conceptopredial':'","'"], "", $DatosBusqueda[8]);
$Ade1 = str_replace(["totalpredial':'","'"], "", $DatosBusqueda[9]);
$concepto2 = str_replace(["conceptobaldios':'","'"], "", $DatosBusqueda[10]);
$Ade2 = str_replace(["totalbaldios':'","'"], "", $DatosBusqueda[11]);
$concepto3 = str_replace(["conceptodap':'","'"], "", $DatosBusqueda[12]);
$Ade3 = str_replace(["totaldap':'","'"], "", $DatosBusqueda[13]);
$concepto4 = str_replace(["conceptoisai':'","'"], "", $DatosBusqueda[14]);
$Ade4 = str_replace(["totalisai':'","'"], "", $DatosBusqueda[15]);
$totalAdeudo = str_replace(["totaladeudo':'","'"], "", $DatosBusqueda[16]);
$dato =str_replace(["dato':'","'"], "", $DatosBusqueda[19]);

$propietario = urldecode(utf8_encode($Propietario));
$ubicacionPre = urldecode(utf8_encode($Ubicacion));
$domicilioPre = urldecode(utf8_encode($Domicilio));
$datoPropiedad = urldecode(utf8_encode($dato));
?>
<script>  setTimeout ("window.external.regresarInicio()",60000); </script>
<div class="fondobusquedo-Predial">
	<div class="Labels">
		<label class="text-labels labpre">Cuenta Predial:</label>
		<label class="text-labels labpro">Propietario:</label>
		<label class="text-labels labubi">Ubicación del Predio:</label>
		<label class="text-labels labdom">Domicilio a motificar:</label>
		<label class="text-labels labult">Último movimiento:</label>
	</div>
	<div class="Respuesta-Predial">
		<label class="tex_Res CuenPre"><?php echo $CuentaPredial ?></label><br>
		<label class="tex_Res Propietario"><?php echo  str_replace(['%','%2'], "", $propietario)?></label>
		<label class="tex_Res UbiPre"><?php echo str_replace(['%','%2'], "", $ubicacionPre) ?></label>
		<label class="tex_Res DomPre"><?php echo str_replace(['%','%2'], "", $domicilioPre) ?></label>
		<label class="tex_Res UltPre"><?php echo str_replace(['%','%2'], "", mb_strtoupper($datoPropiedad,'utf-8')) ?></label>
	</div>
	<div class="Respuesta2">
		<?php 
		if ($Ade1!=".0000") {	
			echo '<label class="text-labels2">IMPUESTO PREDIAL:</label>';
			echo '<label class="tex_Res alieado1">$ '.number_format($Ade1, 2, '.', ',').'</label><br>';
			echo '<label class="text-labels-mini">'.urldecode(utf8_encode($concepto1)).'</label><br>';
		}
		if ($Ade2!=".0000") {	
			echo '<label class="text-labels2">IMPUESTO LOTE BALDIOS:</label>';
			echo '<label class="tex_Res alieado2">$ '.number_format($Ade2, 2, '.', ',').'</label><br>';
			echo '<label class="text-labels-mini">'.urldecode(utf8_encode($concepto2)).'</label><br>';
		}
		if ($Ade3!=".0000") {	
			echo '<label class="text-labels2">DERECHO DE ALUMBRADO PUBLICO (DAP):</label>';
			echo '<label class="tex_Res alieado3">$ '.number_format($Ade3, 2, '.', ',').'</label><br>';
			echo '<label class="text-labels-mini">'.urldecode(utf8_encode($concepto3)).'</label><br>';
		}
		if ($Ade4!=".0000") {	
			echo '<label class="text-labels2">IMPUESTO SOBRE ADQUISICION DE INMUEBLES (ISAI):</label>';
			echo '<label class="tex_Res alieado4">$ '.number_format($Ade4, 2, '.', ',').'</label><br>';
			echo '<label class="text-labels-mini">'.urldecode(utf8_encode($concepto4)).'</label><br>';
		}
		if ($totalAdeudo!=".0000") {
			echo '<label class="text-labels alineado5">TOTAL A PAGAR:</label>';
			echo '<label class="tex_Res alineado6">$ '.number_format($totalAdeudo, 2, '.', ',').'</label>';
		}
		else {
			echo '<label class="text-labels alineado5">ESTE PREDIO NO TIENE ADEUDO.</label>';
		}
		?>
	</div>
	<div class="RespuestaButton">
		<?php 
			if ($totalAdeudo==".0000") {
				echo '<a href="'.base_url().'predial" class="btn-SinPago"></a>';
				echo "<script type='text/javascript'>window.external.reproducirAudio('5')</script>";
				// echo '<input onclick="" name="Regresar" type="submit" value=""  class="btn-pagar"/>';
			}
			else{
				echo '<form id="formpago" action="'.base_url().'predial/pago" method="post">
						<input name="oficina" type="hidden" value="'.$oficina.'" >
						<input name="tipo" type="hidden" value="'.$tipo.'" >
						<input name="numpredio" type="hidden" value="'.$numpredio.'" >
						<input name="Apellido" type="hidden" value="'.$Apellido.'" >
						<input name="sesion" type="hidden" value="'.$sesion.'" >
						<input name="montoadeudo" type="hidden" value="'.$totalAdeudo.'" >
						<input onclick="" name="BUSCAR" type="submit" value=""  class="btn-pagar"/>
					</form>';
					echo "<script type='text/javascript'>window.external.reproducirAudio('7')</script>";
			}			
		?>
	</div>
	
</div>

<a href="<?php echo base_url(); ?>predial" id="regresar" class="btn-regresar"/>