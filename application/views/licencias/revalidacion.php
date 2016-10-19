<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<?php //echo $MensajeAudio; 
//echo $Oficinas; 
//$giros=json_decode($giro, True);
//foreach ($giros as $key) {
//print_r(($key['GirosId']));
 // print_r(($key['giro']));  
//}
//var_dump(json_decode($giro));

/*style="padding-left: 279px;
                    position: relative;
                    margin-top: 40px;">class="fondolicencias">*/
?>
 
    <div class="contornolicenciasrevalidacion">
        <div class="busquedalicencias">
        <label class="busquedal"><img src="../img/busquedalicencia.png">
           
        </label>
        <div class = "busquedalicenciasimputs">
             <label>Numero de Licencia</label>
             <label><img src="../img/asteriscolicencias.png"></label>
                <label class="labeles9">Tipo de Licencia</label>
                <label><img src="../img/asteriscolicencias.png"></label>
            </br>
             <input type="textbox" class="<?php echo (form_error('textboxNumlicencia') == '') ? '' : 'yes_error'; ?> text-Numlicencia" name="textboxNumlicencia" id="textboxNumlicencia" value="<?php echo empty($_POST['textboxNumlicencia']) ?'': $_POST['textboxNumlicencia']; ?>" maxlength="300"/> 
             <select class=" <?php echo (form_error('imput_giro') == '') ? '' : 'yes_error'; ?> form-control cajatipolicencias" name="imput_giro" id="idselect">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
             </select>
             <label class="labeles10">Ap. Paterno/Empresa</label>
             <label><img src="../img/asteriscolicencias.png"></label>

        </div>
        
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


//NUMEROS
$("#textboxNumEmpleos, #textboxInvEstimada, #NumPredio").keypress(function(e) {
    var tecla = e.keyCode || e.which;           
            if (tecla==8||tecla==13) return true; // 3
            patron = /[0-9]/; //numeros 
            te = String.fromCharCode(tecla); // 5
            return patron.test(te);
    });


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