<script>  setTimeout("window.external.regresarInicio()", 120000);</script>
<?php
$datosLicencia = json_decode($licencia, True);?>
<div class="contornodatosrevalidacion">
     <?php
     if ($datosLicencia[0]['estatus'] == 1)
     {
        echo form_open('licencias/busquedaLicencia', $attributes);
        ?>
        <div class="lblTitleRevalida"></div>
        <div class="datosPropietario">
            <label><b>Propietario:</b></label>
            <label><?php echo ucwords(strtolower(str_replace("%20", " ", $datosLicencia[0]['propietario'])));?></label>
            <br/><br/>
            <label><b>Domicilio:</b></label>
            <label><?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['domicilio']))) ;?></label>
            <br/><br/>
            <label><b>Giro de actividad:</b></label>
            <label><?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['giro'])));?></label>
            <br/><br/>
            <label><b>Genero de Licencia:</b></label>
            <label><?php echo $datosLicencia[0]['Genero'];?></label>
            &nbsp;
            <label><b>Num de Licencia:</b></label>
            <label><?php echo $datosLicencia[0]['Licencia'];?></label>
             &nbsp;
            <label><b>Num de Predio:</b></label>
            <label><?php echo $datosLicencia[0]['ctapredial'];?></label>
             <br/><br/>
            <label><b>Ultimo Año Revalidado:</b></label>
            <label><?php echo $datosLicencia[0]['RevaUltima'];?></label>
        </div>
        
    <input class="btnGuardaRevalidacion" type="submit" value="" name="guardarevalida" id = "guardarevalida"/>
    <?php form_close();
     }else
     {?>
            <div class="result">
            <?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['respuesta'])));?>
            </div>
    <?php }?>
    
</div>

<a href="<?php echo base_url() . 'licencias/revalidacion'; ?>" id="regresar" class="btn-regresarlicencias"></a>

<script type="text/javascript">
    $(function desactivar() {
        var LastyearRevalidation = <?php echo $datosLicencia[0]['RevaUltima'];?>;
        var CurrentYear = <?php echo date(Y);?>;
    if(LastyearRevalidation == CurrentYear) {
        $("#guardarevalida").attr('disabled', 'disabled');
        console.log('se supone que deberia deshabilitarse');
    }
    else {
        $("#guardarevalida").removeAttr("disabled");
        console.log('deberia estar activo');
}});
</script>

