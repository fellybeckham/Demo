<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

?>
<div class="fondolicencias">

<div class="datoslicencias">
<label>Datos del solicitante</label>
</br>
</br>
<form action="POST">
 <label class="radio-inline">
  <input type="radio" checked="checked" name="checkboxPFISICA" id="checkboxPFISICA" value="0"> P. Fisica
</label>
<!--<label class="radio-inline">
  <input type="radio" name="checkboxPMORAL" id="inlineRadio2" value="1"> 2
</label>-->

<input type="radio" value="1" name="checkboxPFISICA" id="checkboxPMORAL">
<label>P. Moral</label>
<!--<input type="radio" value="1" name="checkboxPMORAL" id="checkboxPMORAL"> 
<label>P. Moral</label>-->
</br>
</br>
<label>Paterno/Empresa</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles">Materno</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles2">Nombre</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" class="text" name="textboxPaternoEmpresa" id="textboxPaternoEmpresa" /> 
<input type="textbox" class="text" name="textboxMaterno" id="textboxMaterno" /> 
<input type="textbox" class="text" name="textboxMaterno" id="textboxMaterno" /> 
<br>
<div id="fisica">
<label>Num. de Telefono</label>
<label><font color="#7401DF">*</font></label>
<label>Email</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" name="textboxtelefono" id="textboxtelefono" /> 
<input type="textbox" class="text" name="textboxEmail" id="textboxEmail" /> 
</div>
</br>
</br>
<label>Datos del negocio</label>
</br>
</br>
<label>Giro Principal</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles6">Nombre Establecimiento</label>
</br>
<select class="form-control">
<option>Lista de giros1</option>
<option>Lista de giros2</option>
<option>Lista de giros3</option>
<option>Lista de giros4</option>
</select>
<input type="textbox" class="text-complete" name="textboxEmail" id="textboxEmail" /> 
</br>
</br>

<label>Calle</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles3">No. ext. No. Int.</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" class="text-calle" name="textboxcalle" id="textboxcalle" /> 
<input type="textbox" name="textboxnum" id="textboxnum" /> 
</br>

<label>Colonia</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles3">Cod. Postal</label>
</br>
<input type="textbox" class="text-calle" name="textboxcolonia" id="textboxcalle" /> 
<input type="textbox" name="textboxCP" id="textboxnum" /> 
</br>
<label>Entre calle 1</label>
<label class="labeles4">Entre calle 2</label>
</br>
<input type="textbox" class="text-entre-calle" name="textboxCalle1" id="textboxcalle" /> 
<input type="textbox" class="text-entre-calle" name="textboxCalle2" id="textboxnum" /> 
</br>
</br>
<label># de Empleos</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles5">Inv. Estimada</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" name="textboxtelefono" id="textboxtelefono" /> 
<input type="textbox" class="text" name="textboxEmail" id="textboxEmail" /> 
</br>
</br>
<label class="labeles7"><font color="#7401DF">*</font></label>
<label>Datos obligatorios </label>
<input type="button" class="btn-imprimirr" name="buttonimprimir" id="textboxnum" value="Imprimir Solicitud" /> 
</form>
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