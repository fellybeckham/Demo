<script>
$(document).ready(function(){
	//Almacena en la variable la ruta donde se encuentra el proyecto
	var url = "<?php echo $url;?>";
	//Alamacena la referencia
	var referencia = "<?php echo $referencia;?>";
	//Carga la vista que contiene el xml para imprimir el archivo pdf
        //alert(url+"licencias/variablesPDF?referencia="+referencia);
   window.location.replace(url+"licencias/variablesPDF?referencia="+referencia);
});
</script>