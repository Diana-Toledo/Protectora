function getHistorialAnimalValue( idAnimal ) {
	let datos;
	
	datos = "accion=getHistorialAnimal&idAnimal=" + idAnimal;
					
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ( "Se ha producido un error." );
		},
		success: function ( data, textStatus ) {
			var arDataAnimals;
		
			arDataAnimals = JSON.parse( data );
			
			switch ( arDataAnimals[ "status" ][ "codError" ] ) {
				case "000":
				case "001":
					$( "input[ name='fecencontrado' ]" ).val( arDataAnimals[ "data" ][ 0 ][ "fecencontrado" ] );
					$( "input[ name='lugarencontrado' ]" ).val( arDataAnimals[ "data" ][ 0 ][ "lugarencontrado" ] );
				break;
				case "002":
				break;
				default:
			}	
		}   
	});
	
}

