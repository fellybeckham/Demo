<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

?>
<div class="fondolicencias">

<div class ="opciones">
    <div class ="boton_apertura">
        <a title="aperturar" href="<?echo base_url().'licencias/apertura'?>"><IMG SRC="img/iconoapertura.png"></a>
    </div>
    <div class ="boton_revalidacion">
        <a title="revalidar" href="<?echo base_url().'licencias/revalidacion'?>"><IMG SRC="img/iconorevalidacion.png"></a>
    </div>        
</div>
<?php
echo form_close();
?>
<label class="tex_MensajeErrorAgua"><?php echo $MensajeError; ?></label>
<?php

?>
</div>

<a href="<?php echo base_url(); ?>" id="regresar" class="btn-regresar"></a>

<script type="text/javascript">
//function submitform()
//{
  //  document.forms["myform"].submit();
//}
</script>

<script type="text/javascript">
/*document.getElementById("CodBarra").focus();
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
        
    });*/

$('input[name="checkboxPFISICA"]').click(function() {
//Se verifica si alguno de los radios esta seleccionado
    if ($('#checkboxPFISICA').is(':checked')) {
        //alert('Borrar telefono y email');
        $('#fisica').hide();
    } else {
        $('#fisica').show();
    }
});
</script>