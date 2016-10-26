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
            <label>Propietario:</label>
            <label><?php echo ucwords(strtolower(str_replace("%20", " ", $datosLicencia[0]['propietario'])));?></label>
            <br/><br/>
            <label>Domicilio:</label>
            <label><?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['domicilio']))) ;?></label>
            <br/><br/>
            <label>Giro de actividad:</label>
            <label><?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['giro'])));?></label>
            <br/><br/>
            <label>Genero de Licencia:</label>
            <label><?php echo $datosLicencia[0]['Genero'];?></label>
            &nbsp;
            <label>Num de Licencia:</label>
            <label><?php echo $datosLicencia[0]['Licencia'];?></label>
             &nbsp;
            <label>Num de Predio:</label>
            <label><?php echo $datosLicencia[0]['ctapredial'];?></label>
             <br/><br/>
            <label>Ultimo Año Revalidado:</label>
            <label><?php echo $datosLicencia[0]['RevaUltima'];?></label>
        </div>
        
    <input class="btnGuardaRevalidacion" type="submit" value=""/>
    <?php form_close();
     }else
     {?>
            <div class="result">
            <?php echo ucfirst(strtolower(str_replace("%20", " ", $datosLicencia[0]['respuesta'])));?>
            </div>
    <?php }?>
    
</div>

<a href="<?php echo base_url() . 'licencias/revalidacion'; ?>" id="regresar" class="btn-regresarlicencias"></a>

