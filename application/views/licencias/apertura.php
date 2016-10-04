<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php echo $MensajeAudio; 
//echo $Oficinas; 

if (!empty($dataapertura)) {
    echo $dataapertura;
    }
    else{
        echo $dataapertura;
    }

?>
<div class="fondolicencias">

<div class="datoslicencias">
<label>Datos del solicitante</label>
</br>
</br>

 <label class="radio-inline">
  <input type="radio" name="checkboxPFISICA" id="checkboxPFISICA" value="0"> P. Fisica
</label>
<!--<label class="radio-inline">
  <input type="radio" name="checkboxPMORAL" id="inlineRadio2" value="1"> 2
</label>-->

<input type="radio" checked="checked" value="1" name="checkboxPFISICA" id="checkboxPMORAL">
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

<form action="<?php echo base_url().'licencias/apertura'; ?>" method="POST">
<input type="textbox" class="text" name="textboxPaternoEmpresa" id="textboxPaternoEmpresa" value="<?php echo empty($_POST['textboxPaternoEmpresa']) ?'': $_POST['textboxPaternoEmpresa']; ?>"/> 
<input type="textbox" class="text" name="textboxMaterno" id="textboxMaterno" value="<?php echo empty($_POST['textboxMaterno']) ?'': $_POST['textboxMaterno']; ?>"/> 
<input type="textbox" class="text" name="textboxNombre" id="textboxNombre" value="<?php echo empty($_POST['textboxNombre']) ?'': $_POST['textboxNombre']; ?>"/> 
<br>
<div id="fisica">
<label>Num. de Telefono</label>
<label><font color="#7401DF">*</font></label>
<label>Email</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" name="textboxtelefono" id="textboxtelefono" value="<?php echo empty($_POST['textboxtelefono']) ?'': $_POST['textboxtelefono']; ?>"/> 
<input type="textbox" class="text" name="textboxEmail" id="textboxEmail" value="<?php echo empty($_POST['textboxEmail']) ?'': $_POST['textboxEmail']; ?>"/> 
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
<select class="form-control" name="imput_giro">
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
</select>
<input type="textbox" class="text-complete" name="textboxNombreEstablecimiento" id="textboxEmail" value="<?php echo empty($_POST['textboxNombreEstablecimiento']) ?'': $_POST['textboxNombreEstablecimiento']; ?>"/> 
</br>
</br>

<label>Calle</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles3">No. ext. No. Int.</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" class="text-calle" name="textboxcalle" id="textboxcalle" value="<?php echo empty($_POST['textboxcalle']) ?'': $_POST['textboxcalle']; ?>"/> 
<input type="textbox" name="textboxnum" id="textboxnum" value="<?php echo empty($_POST['textboxnum']) ?'': $_POST['textboxnum']; ?>"/> 
</br>

<label>Colonia</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles3">Cod. Postal</label>
</br>
<input type="textbox" class="text-calle" name="textboxcolonia" id="textboxcalle" value="<?php echo empty($_POST['textboxcolonia']) ?'': $_POST['textboxcolonia']; ?>"/> 
<input type="textbox" name="textboxCP" id="textboxnum" value="<?php echo empty($_POST['textboxCP']) ?'': $_POST['textboxCP']; ?>"/> 
</br>
<label>Entre calle 1</label>
<label class="labeles4">Entre calle 2</label>
</br>
<input type="textbox" class="text-entre-calle" name="textboxCalle1" id="textboxcalle" value="<?php echo empty($_POST['textboxCalle1']) ?'': $_POST['textboxCalle1']; ?>"/> 
<input type="textbox" class="text-entre-calle" name="textboxCalle2" id="textboxnum" value="<?php echo empty($_POST['textboxCalle2']) ?'': $_POST['textboxCalle2']; ?>"/> 
</br>
</br>
<label># de Empleos</label>
<label><font color="#7401DF">*</font></label>
<label class="labeles5">Inv. Estimada</label>
<label><font color="#7401DF">*</font></label>
</br>
<input type="textbox" name="textboxNumEmpleos" id="textboxtelefono" value="<?php echo empty($_POST['textboxNumEmpleos']) ?'': $_POST['textboxNumEmpleos']; ?>"/> 
<input type="textbox" class="text" name="textboxInvEstimada" id="textboxEmail" value="<?php echo empty($_POST['textboxInvEstimada']) ?'': $_POST['textboxInvEstimada']; ?>"/> 
</br>
</br>
<label class="labeles7"><font color="#7401DF">*</font></label>
<label>Datos obligatorios </label>
<input type="submit" class="btn-imprimirr" name="buttonimprimir" id="textboxnum" value="Imprimir Solicitud" />
</br>
</br>
<input type="reset" class="btn-limpiarr" name="buttonreset" id="textboxnum" value="Limpiar" /> 
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