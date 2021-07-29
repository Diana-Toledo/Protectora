<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Usuarios</title>		
		<link rel="stylesheet" href="css/style.css">		
		<link rel="stylesheet" href="css/overlayUpdate.css">
		<link rel="stylesheet" href="css/form.css">
		<link rel="stylesheet" href="css/cards.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
		<script src="jquery/jquery-3.6.0.js"></script>
		<script src="js/petasincronas.js"></script>

		<script>
			$( function() {
				$( "div.overlayupdate" ).on( { 
					"click": function( event ) {
						if ( event.target === event.currentTarget ) {
							console.log( "ocultamos" );
							$( this ).removeClass( "visible" );
						}						
					}
				});		

				// Al pulsar en el enlace de Editar.
				$( "#users .tarjeta p:last-child" ).on( { 
					"click": function( event ) {
						let idUsuario, nomUsuario, apellidos, dni, email, contrasena, fecNacimiento, telefono, fecAlta, imgUsuario;
						nodoP = $( this ).parent();
						$( nodoP ).children( "p" ).each( function( index ) {							
							switch ( index ) {
								case 0:
									idUsuario = $( this ).attr( "data-id" );										
									nomUsuario = $( this ).html();		
								break;
								case 1:
									apellidos = $( this ).html();
								break;
								case 2:
									dni = $( this ).html();
								break;								
								case 3:
									fecNacimiento = $( this ).html();
								break;
								case 4:
									email = $( this ).html();
								break;
								case 5:
									contrasena = $( this ).html();
								break;								
								case 6:
									telefono = $( this ).html();
								break;									
								case 7:
									fecAlta = $( this ).html();
								break;								
								case 8:
									imgUsuario = $( this ).html();
								break;								
							}
						});

						$( "input[ name='nomusuario' ]" ).val( nomUsuario );
						$( "input[ name='nomusuario' ]" ).attr( "data-id", idUsuario );
						$( "input[ name='apellidos' ]" ).val( apellidos );
						$( "input[ name='dni' ]" ).val( dni );				
						$( "input[ name='imgusuario' ]" ).val( imgUsuario );				
						$( ".overlayupdate" ).addClass( "visible" );					
					}
				});
								
				// Click en el botón actualizar.
				$( ".overlayupdate input[ type='button' ]" ).on( { 
					"click": function( event ) {
						
						datos =	{	"accion" : "actUser", 
									"idusuario"	    : $( "input[ name='nomusuario' ]" ).attr( "data-id" ),
									"nomusuario"    : $( ".overlayupdate input[ name='nomusuario' ]" ).val(),
									"apellidos"		: $( ".overlayupdate input[ name='apellidos' ]" ).val(),
									"dni"			: $( ".overlayupdate input[ name='dni' ]" ).val(),
									"imgusuario"	: $( ".overlayupdate input[ name='imgusuario' ]" ).val()									
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
										$("div#users div.tarjeta").children().each( function( index ) {
											let nodoSig;
											let arNames = [ 'nomusuario', 'apellidos', 'dni' ];
											switch ( index ) {
												case 0:
													$( this ).attr( "src", $( ".overlayupdate input[ name='imgusuario' ]" ).val() );
													break;
												case 1:
												case 2:
												case 3:
												
													$( this ).html( $( ".overlayupdate input[ name='" + arNames[ index - 1 ] + "' ]" ).val() );
													break;
											}	

										} );
										
										$( "div.overlayupdate" ).trigger( "click" );
									break;
									case "002":
										// Mensaje de error.
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
		<?php
			echo $arTableUsers[ 1 ];
		?>		
		<a class='enlace' href='usuarioss'></a>		
		<div class='overlayupdate'>
			<div class='formulario'>
				<h3>Actualización usuario</h3>	
				<div class='form'>			
					<div> 
						Nombre:<br><input type='text' name='nomusuario' placeholder='Nombre del usuario' maxlength='20' />
					</div>
					<div> 
						Apellido:<br><input type='text' name='apellidos' placeholder='Apellidos'  maxlength='30' />
					</div>
					<div> 
						DNI:<br><input type='text' name='dni' placeholder='DNI' maxlength='9' />
					</div>
					<div> 
						Imagen:<br><input type='text' name='imgusuario' placeholder='Imagen' maxlength='50' />
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