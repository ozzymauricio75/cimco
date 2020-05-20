    $(document).ready(function() {
        ejecutarFuncionesGlobales();
    });


    function recargarPlazo(){
	var dias_inicial = parseInt($('#inicial').val());
	var lista = '';
	for (i=dias_inicial; i <= 360 ; i=i+30) {
	    lista = lista+'<option value="'+i+'">'+i+'</option>';
	}
	$('#final').html(lista);
    }