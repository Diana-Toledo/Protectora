<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Animales</title>
		<link rel='stylesheet' href='css/style.css'>
		<link rel="stylesheet" href="css/overlay.css">
		<link rel='stylesheet' href='css/form.css'>
		<link rel="stylesheet" href="css/cards.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">       
		<script src="jquery/jquery-3.6.0.js"></script>
		<script>
			function clickNameAnimal() {
				$( "table#listanimales tbody td:nth-child( 2 )" ).off( "click" );
				$( "table#listanimales tbody td:nth-child( 2 )" ).on( { 
					"click": function( event ) {
						event.stopPropagation();						
						if ( event.target.nodeName === "TD" ) {
							$( "#nameanimal" ).html( $( this ).children( "a" ).html() );
							$( ".overlay" ).removeClass( "ocultoD" );				
						}					
					}
				});
			}		
			
			$( function() {				
				clickNameAnimal();				
				$( ".overlay" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
						$( this ).addClass( "ocultoD" );
					}					
				});

				$( "a[ href='#altaanimal' ]" ).on( { 
					"click": function( event ) {
						event.preventDefault();						
						$( ".wrapper" ).removeClass( "ocultoDI" );
					}					
				});
				
				$( ".wrapper" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
						$( this ).addClass( "ocultoDI" );
					}					
				});
				
				$( ".wrapper .formulario" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
					}					
				});
				
				$( ".wrapper .formulario input[ type='button' ] " ).on( { 
					"click": function( event ) {
						
						let retorno        = true;
						let mensaje        = "";				
						let nomAnimal      = $( ".wrapper .formulario input[ name='nomanimal' ]" ).val();
						let sexo           = $( ".wrapper .formulario input[ name='sexo' ]" ).val();
						let anioNacimiento = $( ".wrapper .formulario input[ name='anionacimiento' ]" ).val();
						let imgAnimal      = $( ".wrapper .formulario input[ name='imganimal' ]" ).val();
						let peso           = $( ".wrapper .formulario input[ name='peso' ]" ).val();
						let altura         = $( ".wrapper .formulario input[ name='altura' ]" ).val();
						let desAnimal      = $( ".wrapper .formulario textarea[ name='desanimal' ]" ).val();					
						let idRaza         = $( ".wrapper .formulario select[ name='idraza' ]" ).val();
						let nomRaza        = $( "select[ name='idraza' ] option:selected" ).text();
						
											
						if ( nomAnimal.length === 0 ) {
							mensaje+= "<p>El nombre del animal está vacío.</p>";
							retorno = false;
						}
						if ( nomAnimal.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en el nombre del animal.</p>";
							retorno = false;
						}
						
						if ( sexo.length === 0 ) {
							mensaje+= "<p>El campo sexo del animal está vacío.</p>";
							retorno = false;
						}
						if ( anioNacimiento.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en la descripción de la raza.</p>";
							retorno = false;
						}
						if ( imgAnimal.length === 0 ) {
							mensaje+= "<p>La imagen no puede quedar vacía.</p>";
							retorno = false;
						} 
						
						if ( !retorno ) {
							layermsg.innerHTML = mensaje;
						}						
						
						if ( retorno ) {
							
							datos =	{	"accion"         : "insAnimal", 
										"nomanimal"      : nomAnimal, 
										"sexo"           : sexo, 
										"anionacimiento" : anioNacimiento,  
										"imganimal"      : imgAnimal,
										"peso"           : peso,
										"altura"         : altura, 
										"desanimal"      : desAnimal,
										"idraza"         : idRaza,
										"nomraza"        : nomRaza
									};
							
							$.ajax ( {
								type: "POST",
								url: "ajax/controladorAJAX.php",
								data: datos,
								error: function() {
									alert ( "Se ha producido un error." );
								},
								success: function ( data, textStatus ) {
									let bInsertado = false;
									$( "table#listanimales .filas .tarjeta h4:nth-child( 1 ) a" ).each( function( index ) {
										if ( $( this ).text() > nomAnimal && !bInsertado ) {
											nodoPadre = $( this ).parent().parent();
											$( data.trim() ).insertBefore( nodoPadre );											
											bInsertado = true;
										}										
									});

									if ( !bInsertado ) { // inserto.
										$( data.trim() ).insertBefore( "table#listanimales .filas .tarjeta h4" );
									}

									// Limpiar los campos del formulario.
									$( "input[ name='nomanimal' ]" ).val( "" );
									$( "input[ name='sexo' ]" ).val( "" );
									$( "input[ name='anionacimiento' ]" ).val( "" );
									$( "input[ name='imganimal' ]" ).val( "" );
									$( "input[ name='peso' ]" ).val( "" );
									$( "input[ name='altura' ]" ).val( "" );
									$( "textarea[ name='desanimal' ]" ).val( "" );
									$( "select[ name='idraza' ]" ).val( "-1" );
									$( ".wrapper" ).trigger( "click" );									
									clickNameAnimal();									
								}   
							});
						} else {						
						}						
						return false;												
					}					
				});
				
			} );
		</script>
	</head>
	<body>
		<div class='anchura80'>		
		<?php
			echo $arTableAnimals[ 1 ];
			echo $arTableAnimals[ 2 ];
		?>		
		</div>				
		<a class="enlace" href='#altaanimal'>Dar de alta animal nuevo.</a>
		<div class='wrapper ocultoDI'>
			<div class='formulario'>
				<h2>Alta de Animal</h2>
				<div class='form'>
					<div> 
						<input type='text' name='nomanimal' placeholder='Nombre' maxlength='20' />
					</div>
					<div> 
						<input type="radio" name="sexo" value="true" maxlength="4" placeholder="Sexo" >Hembra
					</div>
					<div>
        				<input type="radio" name="sexo" value="false" maxlength="4" placeholder="Sexo" >Macho
					</div>
					<div> 
						<input type="text" name="anionacimiento" maxlength="" placeholder="Año de nacimiento" />
					</div>
					<div> 
						<input type="text" name="imganimal" maxlength="50" placeholder="Imagen"><br>
					</div>
					<div> 
						<input type="text" name="peso" maxlength="30"  placeholder="Peso" />
					</div>
					<div> 
					<input type="text" name="altura" maxlength="30"  placeholder="Altura" />
					</div>
					<div> 
					<textarea name='desanimal' placeholder='Descripción animal'></textarea>
					</div>
					<div> 
						<?php
							echo $layerSelect;
						?>
					</div>
					<div>
						<input type="button" value="Grabar" />
					</div>
				</div>			
				<div id='layermsg'></div>
			</div>
		</div>
	</body>
</html>