<script>  setTimeout ("window.external.regresarInicio()",60000); </script>
<div class="fondopagoP">
	<label class="mensaje-Pago">Importe a pagar $ <?php echo number_format($montoadeudo, 2, '.', ',')?></label>
	<ul class="box-forma-pago">
	   <li>
	   	<a href="" onclick="window.external.reproducirAudio('1')" class="btn-pagotarjeta"></a>
	   </li>
	   <li>
	   	<?php 
	   		echo '<form id="formpago" action="'.base_url().'predial/vendingcobrar" method="get">
			<input name="oficina" type="hidden" value="'.$oficina.'" >
			<input name="tipo" type="hidden" value="'.$tippredio.'" >
			<input name="numpredio" type="hidden" value="'.$numpredio.'" >
			<input name="Apellido" type="hidden" value="'.$Apellido.'" >
			<input name="sesion" type="hidden" value="'.$session.'" >
			<input name="montoadeudo" type="hidden" value="'.$montoadeudo.'" >
			<input onclick="" type="submit" value=""  class="btn-pagoefectivo"/>
			</form>';
	   	?>
	   	<!-- <a href="" onclick="window.external.reproducirAudio('1')" class="btn-pagoefectivo"></a> -->
	   </li>
	</ul>
	<?php 
	echo '<form id="formpago" action="'.base_url().'predial/RegresarPredial" method="post">
			<input name="oficina" type="hidden" value="'.$oficina.'" >
			<input name="tipo" type="hidden" value="'.$tippredio.'" >
			<input name="numpredio" type="hidden" value="'.$numpredio.'" >
			<input name="Apellido" type="hidden" value="'.$Apellido.'" >
			<input name="sesion" type="hidden" value="'.$session.'" >
			<input onclick="" type="submit" value=""  class="btn-regresar no-border" />
		</form>'
	?>
	
</div>