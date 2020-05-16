    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });

    function modificaFotoPrincipal(){
        if ($(".elimina_foto_principal").is(":checked")){
            $(".foto_principal").parent().hide();
        } else {
            $(".foto_principal").parent().show();
        }
    }
