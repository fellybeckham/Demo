<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php //echo $MensajeAudio; 
//echo $Oficinas; 
//$giros=json_decode($giro, True);
//foreach ($giros as $key) {
//print_r(($key['GirosId']));
 // print_r(($key['giro']));  
//}
//var_dump(json_decode($giro));
?>


<div class="fondolicencias">
    <div class="contornolicencias">

<div class="datoslicencias">
<label>Datos del solicitante</label>
</br>
</br>
<div class="solicitante">
<form action="<?php echo base_url().'licencias/mostrarpdf'; ?>" method="POST">
 <input type="radio" name="checkboxPFISICA" id="checkboxPFISICA" value="1">
 <label class="radio-inline">
   P. Fisica
</label>
<!--<label class="radio-inline">
  <input type="radio" name="checkboxPMORAL" id="inlineRadio2" value="1"> 2
</label>-->

<input type="radio" name="checkboxPFISICA" id="checkboxPMORAL" value="2">
<label>P. Moral</label>
<!--<input type="radio" value="1" name="checkboxPMORAL" id="checkboxPMORAL"> 
<label>P. Moral</label>-->
</br>
</br>
<label>Paterno/Empresa</label>
<!--<label><font color="#7401DF">*</font></label>-->
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles ocultaimputs">Materno</label>
<label class="ocultaimputs"><img src="../img/asteriscolicencias.png"></label>
<label class="labeles2 ocultaimputs">Nombre</label>
<label class="ocultaimputs"><img src="../img/asteriscolicencias.png"></label>
</br>

<!--<form action="<?php echo base_url().'licencias/mostrarpdf'; ?>" method="POST">-->
<input type="hidden" class="text" name="indicadortipopersona" value=""/>
<input type="textbox" class="<?php echo (form_error('textboxPaternoEmpresa') == '') ? '' : 'yes_error'; ?>  text-paterno-empresa1" name="textboxPaternoEmpresa" id="textboxPaternoEmpresa" value="<?php echo empty($_POST['textboxPaternoEmpresa']) ?'': $_POST['textboxPaternoEmpresa']; ?>" maxlength="300"/> 
<input type="textbox" class="<?php echo (form_error('textboxMaterno') == '') ? '' : 'yes_error'; ?> materno ocultaimputs" name="textboxMaterno"  id="textboxMaterno" value="<?php echo empty($_POST['textboxMaterno']) ?'': $_POST['textboxMaterno']; ?>" maxlength="100"/> 
<input type="textbox" class="<?php echo (form_error('textboxNombre') == '') ? '' : 'yes_error'; ?> nombre ocultaimputs" name="textboxNombre"  id="textboxNombre" value="<?php echo empty($_POST['textboxNombre']) ?'': $_POST['textboxNombre']; ?>" maxlength="100"/> 
<br>

<label>Num. de Telefono</label>
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles8">Email</label>
<label><img src="../img/asteriscolicencias.png"></label>
</br>
<input type="textbox" class = "<?php echo (form_error('textboxtelefono') == '') ? '' : 'yes_error'; ?> textTel" name="textboxtelefono"  id="textboxtelefono" value="<?php echo empty($_POST['textboxtelefono']) ?'': $_POST['textboxtelefono']; ?>" maxlength="15"/> 
<input type="email" class="<?php echo (form_error('textboxEmail') == '') ? '' : 'yes_error'; ?> textEmail" name="textboxEmail"  id="textboxEmail" value="<?php echo empty($_POST['textboxEmail']) ?'': $_POST['textboxEmail']; ?>" maxlength="70"/> 
</div>
</br>
<label>Datos del negocio</label>
</br>
</br>
<div class = "negocio">
<label>Giro Principal</label>
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles6">Nombre Establecimiento</label>
</br>
<input type="hidden" class="text" name="girooculto" id="girooculto" value="<?php echo $sesion ?>"/> 
<select class=" <?php echo (form_error('imput_giro') == '') ? '' : 'yes_error'; ?> form-control caja" name="imput_giro" id="idselect">
<?php
$giros=json_decode($giro, True);
foreach ($giros as $key) {
    echo "<option value='".$key['GirosId']."'".">".urldecode($key['giro'])."</option>"; 
}

?>
</select>

<input type="textbox" class="text-nombre-establecimiento" name="textboxNombreEstablecimiento"  id="textboxNombreEstablecimiento" value="<?php echo empty($_POST['textboxNombreEstablecimiento']) ?'': $_POST['textboxNombreEstablecimiento']; ?>" maxlength="50"/> 

<label>Calle</label>
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles3">No. ext. No. Int.</label>
<label><img src="../img/asteriscolicencias.png"></label>

<input type="textbox" class=" <?php echo (form_error('textboxcalle') == '') ? '' : 'yes_error'; ?> text-calle" name="textboxcalle"  id="textboxcalle" value="<?php echo empty($_POST['textboxcalle']) ?'': $_POST['textboxcalle']; ?>" maxlength="70"/> 
<input type="textbox" class="<?php echo (form_error('textboxnum') == '') ? '' : 'yes_error'; ?> text-num" name="textboxnum"  id="textboxnum" value="<?php echo empty($_POST['textboxnum']) ?'': $_POST['textboxnum']; ?>" maxlength="25"/> 
</br>

<label>Colonia</label>
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles3">Cod. Postal</label>
</br>
<input type="textbox" class="<?php echo (form_error('textboxcolonia') == '') ? '' : 'yes_error'; ?> text-calle" name="textboxcolonia"  id="textboxcolonia" value="<?php echo empty($_POST['textboxcolonia']) ?'': $_POST['textboxcolonia']; ?>" maxlength="45"/> 
<input type="textbox" name="textboxCP" class="text-num" id="textboxCP" value="<?php echo empty($_POST['textboxCP']) ?'': $_POST['textboxCP']; ?>" maxlength="10"/> 
</br>
<label>Entre calle 1</label>
<label class="labeles4">Entre calle 2</label>
</br>
<input type="textbox" class="text-entre-calle" name="textboxCalle1"  id="textboxCalle1" value="<?php echo empty($_POST['textboxCalle1']) ?'': $_POST['textboxCalle1']; ?>" maxlength="50"/> 
<input type="textbox" class="text-entre-calle" name="textboxCalle2"  id="textboxCalle2" value="<?php echo empty($_POST['textboxCalle2']) ?'': $_POST['textboxCalle2']; ?>" maxlength="50"/> 
</br>
<label># de Empleos</label>
<label><img src="../img/asteriscolicencias.png"></label>
<label class="labeles5">Inv. Estimada</label>
<label><img src="../img/asteriscolicencias.png"></label>
</br>
<input type="textbox" class="<?php echo (form_error('textboxNumEmpleos') == '') ? '' : 'yes_error'; ?>" name="textboxNumEmpleos" id="textboxNumEmpleos" value="<?php echo empty($_POST['textboxNumEmpleos']) ?'': $_POST['textboxNumEmpleos']; ?>" maxlength="6"/> 
<input type="textbox" class="<?php echo (form_error('textboxInvEstimada') == '') ? '' : 'yes_error'; ?> text" name="textboxInvEstimada" id="textboxInvEstimada" value="<?php echo empty($_POST['textboxInvEstimada']) ?'': $_POST['textboxInvEstimada']; ?>" maxlength="12"/> 
</br>
</br>
</div>
</br>
<label class="labeles7"><img src="../img/asteriscolicencias.png"></label>
<label>Datos obligatorios</label>
<input type="submit" class="btn-imprimirr" name="buttonimprimir" id="buttonimprimir" value="" />
</br>
</br>
<input type="hidden" class="btn-limpiarr" name="buttonreset" id="textboxnum" value="Limpiar" /> 
</form>
</div>
<?php
echo form_close();
?>
<label class="tex_MensajeErrorCamposValidacion"><?php echo $MensajeError; ?></label>
<?php

?>
</div>
</div>

<a href="<?php echo base_url().'licencias'; ?>" id="regresar" class="btn-regresarlicencias"></a>

<script type="text/javascript">
//function submitform()
//{
  //  document.forms["myform"].submit();
//}
</script>

<script type="text/javascript">
//LETRAS Y NUMEROS
 $("#textboxPaternoEmpresa, #textboxMaterno, #textboxNombre, #textboxtelefono, #textboxNombreEstablecimiento, #textboxcalle, #textboxnum, #textboxcolonia, #textboxCP, #textboxCalle1, #textboxCalle2").keypress(function(e){   
                cadena = $(this).val();
                cadenalength = cadena.length;
                
                var tecla = e.keyCode || e.which; 
                if(cadena === "" && tecla==32 ){return false;}
                if (tecla == 46) {return true;}                
                if(cadena.substring(cadenalength-1) === " " && tecla === 32  ){return false;}                
                
                if (tecla==8||tecla==13||tecla==32) return true; // 3
                if (tecla==32) return false; // 3
                patron = /^[0-9a-zA-ZñÑÃ¡Ã©Ã­Ã³ÃºÃ Ã¨Ã¬Ã²Ã¹Ã€ÃˆÃŒÃ’Ã™Ã?Ã‰Ã?Ã“ÃšÃ±Ã‘Ã¼Ãœ'_\s]+$/; 
                te = String.fromCharCode(tecla); // 5
                $(this).val($(this).val().toUpperCase());
                return patron.test(te);            
            });

/*$("#textboxPaternoEmpresa, #textboxMaterno, #textboxNombre, #textboxtelefono, #textboxNombreEstablecimiento, #textboxcalle, #textboxnum, #textboxcolonia, #textboxCP, #textboxCalle1, #textboxCalle2").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /[A-Za-z0-9_]/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });*/
//NUMEROS
$("#textboxNumEmpleos, #textboxInvEstimada, #NumPredio").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /[0-9]/; //numeros 
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });
//EMAIL
/*$("#textboxEmail").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+); //email 
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });*/

// EMAIL
/*$(document).ready(function() {
    $('#buttonimprimir').click(function(){
        if($("#textboxEmail").val().indexOf('@', 0) == -1 || $("#textboxEmail").val().indexOf('.', 0) == -1) {
            //alert('El correo electrónico introducido no es correcto.');
            //return false;
             $('#textboxEmail').addClass( "yes_error");
        }

        //alert('El email introducido es correcto.');
    });
});*/
/*document.getElementById("textboxPaternoEmpresa").focus();
    $("#textboxPaternoEmpresa").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /^[0-9]+$/; //numeros y letras
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });
    $('#textboxPaternoEmpresa').keyup(function (e){
        if($(this).val().length == 21) 
        {
            document.frm_agua.submit();
        }
        
    });*/

var optionValue = search = "<?php echo $test; ?>"
$("#idselect").val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);

var radiooptionValue = search = "<?php echo $radiobutonpersona; ?>"
if (radiooptionValue == 1 || radiooptionValue == '') {
    $("#checkboxPFISICA").attr('checked', true);

    $('.ocultaimputs').show();
    $('#textboxPaternoEmpresa').removeClass( "text-paterno-empresa2" );
}
else{
      $("#checkboxPMORAL").attr('checked', true);
       $('.ocultaimputs').hide();
        $('#textboxPaternoEmpresa').addClass( "text-paterno-empresa2");
}



$('input[name="checkboxPFISICA"]').click(function() {
//Se verifica si alguno de los radios esta seleccionado
    if ($('#checkboxPFISICA').is(':checked')) {
        //alert('Borrar telefono y email');
        $('.ocultaimputs').show();
        $('#textboxPaternoEmpresa').removeClass( "text-paterno-empresa2" );
       
    } else {
        $('.ocultaimputs').hide();
        $('#textboxPaternoEmpresa').addClass( "text-paterno-empresa2");
        
    }
});
</script>