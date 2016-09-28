<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

?>
<div class="fondobusquedaAgua">
<?php    
$attributes = array('class' => 'box-agua', 'id' => 'frm_agua', 'name' => 'frm_agua');
echo form_open("agua/buscarAgua", $attributes);
?>
        <label class="text-labels-agua labnumerocontratobus">Número de Contrato:</label>
        <label class="text-labels-agua leyendaContrato">(Teclee los 6 Números del Contrato.)</label>
        <label class="text-labels-agua labnexterbus">Número Exterior:</label>
        <label class="text-labels-agua leyendaNumExterior">*No llenar en caso de que en su Recibo no aparezca el Número Exterior o S/N.</label>      
   
        
        <?php 
        echo form_input(array('name'=>'NumeroContrato', 'id'=>'NumeroContrato', 'type'=>'text', 'value'=>set_value('NumeroContrato'),  'maxlength'=>'6', 'class'=>'txtNumcontAgua','size' => '30'));
        echo form_error('NumeroContrato', '<div class="form_error1">', '</div>');
        echo form_input(array('name'=>'NexTer', 'id'=>'NexTer', 'type'=>'text', 'value'=>set_value('NexTer'),  'maxlength'=>'10', 'class'=>'txtNexter','size' => '30'));
        echo form_error('NexTer','<div class="form_error2">', '</div>');?>

    <?php echo form_input(array('name'=>'sesion', 'id'=>'sesion', 'type'=>'hidden', 'value'=>$session));?>
    <input type="hidden" name="pagina"  value='Datos'/>
    <input onclick="" name="BUSCAR" type="submit" value=""  class="btn-buscar-agua"/> 
<?php
echo form_close();
?>
<label class="tex_MensajeErrorAgua"><?php echo $MensajeError; ?></label>
<?php

?>
</div>
<a href="<?php echo base_url(); ?>agua" id="regresar" class="btn-regresar"></a>


<script type="text/javascript">
document.getElementById("NumeroContrato").focus();
    $("#NumeroContrato").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /^[0-9]+$/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });
     $("#NexTer").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /^[a-zA-Z\s0-9\-/]*$/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });
    

</script>