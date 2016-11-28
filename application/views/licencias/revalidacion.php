<script>  setTimeout("window.external.regresarInicio()", 300000);</script>
<div class="contornolicenciasrevalidacion">
    <div class="busquedalicencias">

        <?php
        $attributes = array('id' => 'frmDatosLicencia', 'name' => 'frmDatosLicencia');
        echo form_open('licencias/busquedaLicencia', $attributes);
        ?>
        <div class="lblTitle"></div>
        <div class="txtNoLicencia">
            <label>Numero de licencia</label>
            <input type="hidden" value="<?php echo $sesion; ?>" name="session" id="session"/>
            <div class="asterisco ast-noLicencia"></div>
            <input class="<?php echo (form_error('noLicencia') == '') ? '' : 'yes_error'; ?> inputLicencia" maxlength="12" name="noLicencia" type="text" id="noLicencia" value="<?php echo empty($noLicencia) ? '' : $noLicencia; ?>"/>
            <!--div class="errorNoLicencia"><?php echo form_error('noLicencia'); ?></div-->
        </div>
        <div class="txtTipoLicencia">
            <label>Tipo de licencia</label>
            <div class="asterisco ast-tipoLicencia"></div>
            <div class="selectTipoLicencia">
                <div class="styleSelect">
                    <select  name="tipoLicencia" id="tipoLicencia">
                        <?php
                        $tipos = json_decode($tiposLicencia, True);
                        foreach ($tipos as $licencia) {
                            echo "<option value='" . $licencia['tipo'] . "'" . ">" . urldecode($licencia['genero']) . "</option>";
                        }
                        ?> 
                    </select> 
                </div>
            </div>
<!--            <select class="selectTipoLicencia" name="tipoLicencia" id="tipoLicencia">
            <?php
            $tipos = json_decode($tiposLicencia, True);
            foreach ($tipos as $licencia) {
                echo "<option value='" . $licencia['tipo'] . "'" . ">" . urldecode($licencia['genero']) . "</option>";
            }
            ?>
            </select>-->
            <div class="errorTipoLicencia"><?php echo form_error('tipoLicencia'); ?></div>
        </div>
        <div class="txtApPaterno">
            <label>Ap. Paterno/Empresa</label>
            <div class="asterisco ast-apPaterno"></div>
            <input class="<?php echo (form_error('apPaterno') == '') ? '' : 'yes_error'; ?> inputApPaterno" maxlength="300" name="apPaterno" type="text" id="apPaterno" value="<?php echo empty($apPaterno) ? '' : $apPaterno; ?>"/>
            <!--div class="errorTipoLicencia"><?php echo form_error('apPaterno'); ?></div-->
        </div>
        <div class="footerForm">
            <div class="asterisco ast-obligatoro"></div>
            <div class="lblOblg"><label>Datos obligatorios</label></div>
            <input class="btnBuscar" type="submit" value=""/>
        </div>
        <?php form_close(); ?>
        <div class="msjError">
            <label class="tex_MensajeErrorCamposValidacion"><?php echo $MensajeError; ?></label>
        </div>
    </div> 

</div>
<a href="<?php echo base_url() . 'licencias'; ?>" id="regresar" class="btn-regresarlicencias"></a>

<script type="text/javascript">
//function submitform()
//{
    //  document.forms["myform"].submit();
//}
</script>

<script type="text/javascript">
//LETRAS Y NUMEROS
    $("#textboxPaternoEmpresa, #textboxMaterno, #textboxNombre, #textboxtelefono, #textboxNombreEstablecimiento, #textboxcalle, #textboxnum, #textboxcolonia, #textboxCP, #textboxCalle1, #textboxCalle2").keypress(function (e) {
        cadena = $(this).val();
        cadenalength = cadena.length;

        var tecla = e.keyCode || e.which;
        if (cadena === "" && tecla == 32) {
            return false;
        }
        if (tecla == 46) {
            return true;
        }
        if (cadena.substring(cadenalength - 1) === " " && tecla === 32) {
            return false;
        }

        if (tecla == 8 || tecla == 13 || tecla == 32)
            return true; // 3
        if (tecla == 32)
            return false; // 3
        patron = /^[0-9a-zA-ZñÑÃ¡Ã©Ã­Ã³ÃºÃ Ã¨Ã¬Ã²Ã¹Ã€ÃˆÃŒÃ’Ã™Ã?Ã‰Ã?Ã“ÃšÃ±Ã‘Ã¼Ãœ'_\s]+$/;
        te = String.fromCharCode(tecla); // 5
        $(this).val($(this).val().toUpperCase());
        return patron.test(te);
    });


//NUMEROS
    $("#textboxNumEmpleos, #textboxInvEstimada, #NumPredio,#noLicencia").keypress(function (e) {
        var tecla = e.keyCode || e.which;
        if (tecla == 8 || tecla == 13)
            return true; // 3
        patron = /[0-9]/; //numeros 
        te = String.fromCharCode(tecla); // 5
        return patron.test(te);
    });


    var optionValue = search = "<?php echo $test; ?>"
    $("#idselect").val(optionValue).find("option[value=" + optionValue + "]").attr('selected', true);

    var radiooptionValue = search = "<?php echo $radiobutonpersona; ?>"
    if (radiooptionValue == 1 || radiooptionValue == '') {
        $("#checkboxPFISICA").attr('checked', true);

        $('.ocultaimputs').show();
        $('#textboxPaternoEmpresa').removeClass("text-paterno-empresa2");
    } else {
        $("#checkboxPMORAL").attr('checked', true);
        $('.ocultaimputs').hide();
        $('#textboxPaternoEmpresa').addClass("text-paterno-empresa2");
    }



    $('input[name="checkboxPFISICA"]').click(function () {
//Se verifica si alguno de los radios esta seleccionado
        if ($('#checkboxPFISICA').is(':checked')) {
            //alert('Borrar telefono y email');
            $('.ocultaimputs').show();
            $('#textboxPaternoEmpresa').removeClass("text-paterno-empresa2");

        } else {
            $('.ocultaimputs').hide();
            $('#textboxPaternoEmpresa').addClass("text-paterno-empresa2");

        }
    });
</script>