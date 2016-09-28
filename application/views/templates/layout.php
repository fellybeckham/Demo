<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu</title>
<link href="<?php echo base_url(); ?>css/application.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(),'js/funciones.js'?>"  type="text/javascript" />
<!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>js/selectivizr.js"></script>
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>css/cssDatos.css" media="screen, projection"></noscript>
<![endif]--> 
<script src="<?php echo base_url(),'js/jquery-v1.8.3.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url(),'js/jquery.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url(),'js/jquery.validate.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url(),'js/limpiar_inputs.js'?>" type="text/javascript"></script>
<script type="text/javascript">
function sonido(num) {  try {window.external.reproducirAudio(num);}catch(err) {}  }
  //setTimeout ("window.external.regresarInicio()",60000);
    if(window.history.forward(1) != null){
    window.history.forward(1);}
  /*$(document).ready(function() {
     $('.hover').bind('touchstart touchend', function(e) {
          e.preventDefault();
          $(this).toggleClass('hover_effect');
      });
          });*/
  // function validarfolios(){
  //   window.external.FoliosDisponibles(1,'ACTAS DE NACIMIENTO');
  //   window.external.reproducirAudio('1');
  // }
  // function validarfolios2(){
  //    window.external.FoliosDisponibles(1,'CURP');
  //    window.external.reproducirAudio('1');
  // }
</script>
</head>
  <?php include ('header.php'); ?>
  <div class="breadcrumb">
    <?php if(isset($breadcrumb)){?>
    <?php echo '<img src="'.base_url().'img/'.$breadcrumb.'"/>';}?>
  </div>
  <body > <!-- oncontextmenu="return false;" -->
    <?php date_default_timezone_set("America/Mexico_City");//require 'logs.php';?>
	  <div id="Contenido">
		  <?php echo $vista ?>
	  </div>
  <?php include ('footer.php'); ?>
</body>
</html>