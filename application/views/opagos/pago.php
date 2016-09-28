<script>  setTimeout ("window.external.regresarInicio()",60000); </script>
<div class="fondopago">
	<label class="mensaje-Pago_morado">Importe a pagar $ <?php echo number_format($montoadeudo, 2, '.', ',')?></label>
	<ul class="box-forma-pago">
		<li>
		   	<a onclick="window.external.reproducirAudio('1')" class="btn-pagotarjeta"></a>
		</li>
		<li>
		   	<?php 
		   		echo '<form id="formpago" action="'.base_url().'otrospagos/vendingcobrar" method="get">
					<input name="tipoadeudo" type="hidden" value="'.$tipoingreso.'" >
					<input name="folio" type="hidden" value="'.$Valor2.'" >
					<input name="montoadeudo" type="hidden" value="'.$montoadeudo.'" >
					<input name="ingreso3" type="hidden" value="'.$Valor3.'" >
					<input name="sesion" type="hidden" value="'.$session.'" >
					<input onclick="" type="submit" value=""  class="btn-pagoefectivo"/>
					</form>';
		   	?>
	   		<!-- <a href="" onclick="window.external.reproducirAudio('1')" class="btn-pagoefectivo"></a> -->
	   	</li>
	</ul>
	<?php 
	echo '<form id="formpago" action="'.base_url().'otrospagos/buscarOPagos" method="post">
				<input name="tipoingreso" type="hidden" value="'.$tipoingreso.'" >
				<input name="ingreso2" type="hidden" value="'.$Valor2.'" >
				<input name="ingreso3" type="hidden" value="'.$Valor3.'" >
				<input name="sesion" type="hidden" value="'.$session.'" >
			<input onclick="" type="submit" value=""  class="btn-regresar no-border" />
		</form>'
	?>
	
</div>