<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

?>
<div class="fondobarra">
<?php    
$attributes = array('class' => 'box-agua', 'id' => 'frm_agua', 'name' => 'frm_agua');
echo form_open("agua/buscarAgua", $attributes);
?>
    <input class="txtBarraAgua" name="CodBarra" maxlength="120" id="CodBarra" value="<?php echo  $Barra ?>"/>
    <input type="hidden" name="sesion"  value="<?php echo $session ?>"/>
<?php
echo form_close();
?>
<label class="tex_MensajeErrorAgua"><?php echo $MensajeError; ?></label>
<?php

?>
</div>
<a href="javascript: submitform()" id="consultarDatos" class="btn-Consultar-datos"></a>
<a href="<?php echo base_url(); ?>" id="regresar" class="btn-regresar"></a>

<script type="text/javascript">
function submitform()
{
    document.forms["myform"].submit();
}
</script>
<?php 
$attributes = array('class' => 'myform', 'id' => 'myform', 'name' => 'myform');
echo form_open("agua/BusquedaDatos", $attributes);
?>
 <input type="hidden" name="sesion2"  value="<?php echo $session ?>"/>
<?php
echo form_close();
?>
<script type="text/javascript">
document.getElementById("CodBarra").focus();
    $("#CodBarra").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /^[0-9]+$/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });
    $('#CodBarra').keyup(function (e){
        if($(this).val().length == 21) 
        {
            document.frm_agua.submit();
        }
        
    });
   

</script>