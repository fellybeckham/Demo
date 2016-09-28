<script>  setTimeout ("window.external.regresarInicio()",150000); </script>

<div style="position: absolute; top: 345px; left: 228px; width: 524px; height: 89px; text-align: center">
	<label style="font-size:30px; color:#F00; font-family:"Arial Black", Gadget, sans-serif">ERROR DE CONEXION CON EL SERVIDOR,<br /> INTENTE MAS TARDE.</label>
</div>
<div>
	<?php
	if ($Error=='NoSession') {
		echo '<label style="position: absolute; top: 630px; left: 700px; font-size: 9px; color: gray;">No Exite Session.</label>';
	}
	else{
		echo '<label style="position: absolute; top: 630px; left: 700px; font-size: 9px; color: gray;">Error Desconocido</label>';
	}
	 ?>
</div>
<div >
	<a class="btn-regresar" href="index.php"></a>
</div>
</div>
