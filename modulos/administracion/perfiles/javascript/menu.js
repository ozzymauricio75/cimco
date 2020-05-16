    $(document).ready(function() {
        ejecutarFuncionesGlobales();


        $('.arbolPerfiles :checkbox').change(validarSeleccion);

        /*** (De)seleccionar elementos padres(hijos) ***/
        function validarSeleccion() {
            if ($(this).is(':checked')) {
                $(this).parents(':checkbox').attr('checked','checked');
                console.log('Marcando ...');
            } else {
                $(this).children(':checkbox').removeAttr('checked','checked');
                console.log('Desmarcando ...');
            }
        }
    });

