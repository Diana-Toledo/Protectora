<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Animales</title>		
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/cards.css">
		<link rel="stylesheet" href="css/form.css">		
		<link rel="stylesheet" href="css/overlayAnimals.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
		<script src="jquery/jquery-3.6.0.js"></script>		

		<script>
			$( function() {
				$( "#listanimales tbody td:nth-child( 1 )" ).on( { 
					"click": function() {
						datos = "accion=getPhotoAnimal&idAnimal=" + $( this ).attr( "data-id" );;						
						
						$.ajax ( {
							type: "POST",
							url: "ajax/controladorAJAX.php",
							data: datos,
							error: function() {
								alert ( "Se ha producido un error." );
							},
							success: function ( data, textStatus ) {
								var arDataAnimals
								arDataAnimals = JSON.parse( data );			
							}	
						});   
					}						
				});					
			});
			
		</script>
	</head>
	<body>
		<div class='anchura80'>		
		<?php
			echo $arTableRaces[ 1 ];
		?>
		</div>
 		<a class="enlace" href='razas'>Ver razas</a>		 
	</body>
</html>