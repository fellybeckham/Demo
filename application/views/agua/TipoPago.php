<script>  setTimeout ("window.external.regresarInicio()",120000); </script>
<a onclick="Pago('E')" class="btn-pagoefectivoagua" onclick="window.external.reproducirAudio('1')"></a>  



<?php
$atributos = array('name' => 'form_vending', 'id' => 'form_vending', 'method' => 'get');
echo form_open("agua/vendingcobrar", $atributos);

echo form_input(array('name'=>'sesion', 'id'=>'sesion', 'type'=>'hidden', 'value'=>$session));
echo form_input(array('name'=>'numerocontrato', 'id'=>'numerocontrato', 'type'=>'hidden', 'value'=>$numerocontrato));
echo form_input(array('name'=>'importetotal', 'id'=>'importetotal', 'type'=>'hidden', 'value'=>str_replace(',', '', $importetotal)));
echo form_input(array('name'=>'tipo', 'id'=>'tipo', 'type'=>'hidden', 'value'=>''));
echo form_close();
?>

<a href="javascript: submitform()" id="regresar" class="btn-regresar"></a>


<script type="text/javascript">
function Pago(tipo) {
   document.getElementById("tipo").value = tipo;
    document.form_vending.submit();
}

</script>

<?php
$atributoslabel = array(  'class' => 'lbl-pago');
echo form_label('$'.$importetotal, 'pagar', $atributoslabel);
$atributos = array('name' => 'myform', 'id' => 'myform', 'method' => 'post');
echo form_open("agua/RegresarDatos", $atributos);

echo form_input(array('name'=>'sesion2', 'id'=>'sesion2', 'type'=>'hidden', 'value'=>$session));
echo form_input(array('name'=>'Respuesta', 'id'=>'Respuesta', 'type'=>'hidden', 'value'=>$Respuesta));
echo form_input(array('name'=>'pagina', 'id'=>'pagina', 'type'=>'hidden', 'value'=>$pag));

echo form_close();
?>
<script type="text/javascript">
function submitform()
{
	document.myform.submit();
}
</script>