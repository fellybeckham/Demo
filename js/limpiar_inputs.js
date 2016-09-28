function limpiar() {
    formulario = document.getElementsByTagName("form")
    formulario[0].reset();
    document.getElementById("textnom").focus();
    //VALIDACION DESPUES DE PRESIONAR BOTON IMPRIMIR
    $("#mostrarerrores").hide();
    if ($('#imprimir_reg').length) {
        $('#imprimir_reg').hide();
    }
    if ($('#verificadatos').length) {
        $('#verificadatos').hide();
    }
}