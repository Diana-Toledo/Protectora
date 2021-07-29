<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Animales</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/overlayAnimals.css">
		<script src="jquery/jquery-3.6.0.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
        
		<script src="js/petasincronas.js"></script>
		<script>
			$( function() {
				$( "#listanimales tbody td:nth-child( 1 )" ).on( { 
					"click": function() {					
						datos = "accion=getPhotoAnimal&idAnimal=" + $( this ).attr( "data-id" );
						
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
										layer = "<div class='overlay'>";
										layer+= 	"<div class='subwrapper'>";
										layer+= 		"<div class='datos'>";
										layer+= 			"<img src='" + arDataAnimals[ "data" ][ 0 ][ "photoanimal" ] + "' class='anchura100' />";
										layer+= 			"<h5><i class='fas fa-clinic-medical'></i> " + arDataAnimals[ "data" ][ 0 ][ "nomanimal" ] + "<h5>";			
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "sexo" ] + "</p>";
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "anionacimiento" ] + "</p>";
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "peso" ] + "</p>";
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "altura" ] + "</p>";
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "desanimal" ] + "</p>";
										layer+=				"<p>" + arDataAnimals[ "data" ][ 0 ][ "nomraza" ] + "</p>";
										layer+= 		"</div>";
										layer+= 	"</div>";
										layer+= "</div>";
											
										$( "body" ).append( layer );
								
										$( ".overlay" ).on( { 
											"click": function() {
												$( this ).remove();
											}	
										});
										
									break;
									default:
									
								}	
							}   
						});
						
					}
					
				});
			} );

		</script>
	</head>
	<body>

	<div class='anchura80'>		
		<?php
			echo $arTableAnimals[1];;
		?>
	</div>
		
	</body>
	<script>
	
		$( "input.busqueda" ).on( { 
		"keypress": function( event ) {
			if ( event.keyCode === 13 ) {
				var buscador = $(this);
				var valor = buscador.val();
				window.location.replace("adopciones.php?idanimal=" + valor);
			}			
		}
		});
		
	</script>

</html>