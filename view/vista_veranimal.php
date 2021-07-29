<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Animales</title>		
		<link rel="stylesheet" href="css/style.css">			
		<link rel="stylesheet" href="css/overlayAnimals.css">
		<link rel="stylesheet" href="css/overlayUpdate.css">
		<script src="jquery/jquery-3.6.0.js"></script>
		<link rel="stylesheet" href="css/form.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
		<script src="js/petasincronas.js"></script>

		<script>
			$( function() {
				$( "div.overlayupdate" ).on( { 
					"click": function( event ) {
						if ( event.target === event.currentTarget ) {
							$( this ).removeClass( "visible" );
						}						
					}
				});		
			
				// click editar.
				$( "#listanimales tbody td:last-child" ).on( { 
					"click": function( event ) {
						let idAnimal, nomAnimal, sexo, anioNacimiento, imgAnimal, peso, altura, fecEncontrado, lugarEncontrado, idRaza;
						nodoP = $( this ).parent();
						$( nodoP ).children( "td" ).each( function( index ) {							
							switch ( index ) {
								case 0:
									idAnimal = $( this ).attr( "data-id" );									
									nomAnimal = $( this ).children( "strong" ).html();			
								break;
								case 1:
									sexo = $( this ).html();
								break;
								case 2:
									anioNacimiento = $( this ).html();
								break;
								case 3:
									imgAnimal = $( this ).html();
								break;								
								case 4:
									peso = $( this ).html();							
									peso = peso.split( "." ).join( "" );
									peso = peso.split( " kilos" ).join( "" );
									peso = peso.split( "," ).join( "." );
								break;
								case 5:
									altura = $( this ).html();
									altura = altura.split( "." ).join( "" );
									altura = altura.split( " cm" ).join( "" );
									altura = altura.split( "," ).join( "." );
								break;
								case 6:
									nomRaza = $( this ).html();
								break;				
							}
						});
						
						getHistorialAnimalValue( idAnimal );
						
						$( "input[ name='nomanimal' ]" ).val( nomAnimal );
						$( "input[ name='nomanimal' ]" ).attr( "data-id", idAnimal );
						if ( sexo === "Macho" ) {
							$( "input[ id='genero1' ]" ).attr( "checked", true );
						} else {
							$( "input[ id='genero2' ]" ).attr( "checked", true );
						}
						$( "input[ name='sexo' ]" ).val( sexo );
						$( "input[ name='imganimal' ]" ).val( imgAnimal );					
						$( "input[ name='fecencontrado' ]" ).val( fecEncontrado );
						$( "input[ name='lugarencontrado' ]" ).val( lugarEncontrado );											
						idRaza = $( "select[ name='idraza' ] option:contains('" + nomRaza + "')" ).val()
						$( "select[ name='idraza' ]").val( idRaza );				
						$( ".overlayupdate" ).addClass( "visible" );					
					}
				});
								
				// Click en el botón actualizar.
				$( ".overlayupdate input[ type='button' ]" ).on( { 
					"click": function( event ) {						
						datos =	{	"accion" : "actAnimal", 
									"idanimal"	      : $( "input[ name='nomanimal' ]" ).attr( "data-id" ),
									"nomanimal"       : $( ".overlayupdate input[ name='nomanimal' ]" ).val(),
									"sexo"            : $( ".overlayupdate input[ name='genero' ]:checked" ).val(),
									"imganimal"       : $( ".overlayupdate input[ name='imganimal' ]" ).val(), 
									"fecencontrado"   : $( ".overlayupdate input[ name='fecencontrado' ]" ).val(),
									"lugarencontrado" : $( ".overlayupdate input[ name='lugarencontrado' ]" ).val(),
									"idraza"          : $( ".overlayupdate select[ name='idraza' ]" ).val()
								};						

						$.ajax ( {
							type: "POST",
							url: "ajax/controladorAJAX.php",
							data: datos,
							error: function() {
								alert ( "Se ha producido un error." );
							},
							success: function ( data, textStatus ) {
								let arData;
								let nodoSig;
								let dataId;
								arData = JSON.parse( data );
	
								switch ( arData[ "status" ][ "codError" ] ) {
									case "000":
									case "001": 
										$( "table#listanimales tbody tr td:nth-child( 1 )" ).each( function( index ) {
											let nodoSig;
											dataId = $( this ).attr( "data-id" );
											if ( dataId === $( "input[ name='nomanimal' ]" ).attr( "data-id" ) ) {												
												$( this ).html( "<strong>" + $( ".overlayupdate input[ name='nomanimal' ]" ).val() + "</strong>" );
												nodoSig = $( this ).next();

												if ( $( ".overlayupdate input[ name='genero' ]:checked" ).val() === "true" ) {
													$( nodoSig ).html( "Hembra" );
												} else {
													$( nodoSig ).html( "Macho" );
												}
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='anionacimiento' ]" ).val() );
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='imganimal' ]" ).val() );
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='peso' ]" ).val() );												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='altura' ]" ).val() );
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate select[ name='idraza' ] option:selected" ).text() );
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='fecencontrado' ]" ).val() );												
												nodoSig = $( nodoSig ).next();
												$( nodoSig ).html( $( ".overlayupdate input[ name='lugarencontrado' ]" ).val() );
											}
										} );
										
										$( "div.overlayupdate" ).trigger( "click" );
									break;
									case "002":
									break;
									default:
									break;
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
			echo $arTableAnimals[ 1 ];
		?>
		</div>
		<a class='enlace' href='animales'>Ver animales</a>
		
		<div class='overlayupdate'>
			<div class='formulario'>
				<h3>Actualización animal</h3>	
				<div class='form'>
					<div> 
						Nombre:<br> <input type='text' name='nomanimal' placeholder='Nombre del animal' maxlength='20' />
					</div>
					<div> 
						Sexo:<br> 
						<input type="radio" id="genero2" name="genero" value='true'>Hembra
					</div>
					<div>
        				<input type="radio" id="genero1" name="genero" value='false'>Macho
					</div>
					<div>
						Imagen:<br><input type='text' name='imganimal' placeholder='Imagen animal' maxlength='50' />
					</div>									
					<div> 
						Fecha encontrado:<br><input type='date' name='fecencontrado' placeholder='Fecha encontrado' />
					</div>
					<div> 
						Lugar encontrado:<br><input type='text' name='lugarencontrado' placeholder='Lugar encontrado' maxlength='50' />
					</div>
					<div> 
						<?php
							echo $layerSelect;
						?>
					</div>					
					<div>
						<input type="button" value="Actualizar" />
					</div>
				</div>
				<div id='layermsg'></div>
			</div>
		</div>		
	</body>
</html>