<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Usuarioss</title>
		<link rel='stylesheet' href='css/style.css'>
		<link rel="stylesheet" href="css/overlay.css">
		<link rel='stylesheet' href='css/form.css'>
		<script src="jquery/jquery-3.6.0.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
        
		<script>
			function clickNameUser() {
				$( "table#users tbody td:nth-child( 2 )" ).off( "click" );
				$( "table#users tbody td:nth-child( 2 )" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
						
						if ( event.target.nodeName === "TD" ) {
							$( "#nameuser" ).html( $( this ).children( "a" ).html() );
							$( ".overlay" ).removeClass( "ocultoD" );
						}					
					}
				});
			}		

			$( function() {				
				clickNameUser();
				
				$( ".overlay" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
						$( this ).addClass( "ocultoD" );
					}					
				});
				
				$( "a[ href='#altausuario' ]" ).on( { 
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
						
						let retorno = true;
						let mensaje = "";				
						let nomUsuario  = $( ".wrapper .formulario input[ name='nomusuario' ]" ).val();
						let apeUsuario  = $( ".wrapper .formulario input[ name='apellidos' ]" ).val();
						let dniUsuario  = $( ".wrapper .formulario input[ name='dni' ]" ).val();
						let mailUsuario = $( ".wrapper .formulario input[ name='email' ]" ).val();
						let passUsuario = $( ".wrapper .formulario input[ name='contrasena' ]" ).val();
						let fecUsuario  = $( ".wrapper .formulario input[ name='fecnacimiento' ]" ).val();
						let telUsuario  = $( ".wrapper .formulario input[ name='telefono' ]" ).val();
						let altaUsuario = $( ".wrapper .formulario input[ name='fecalta' ]" ).val();
						let imgUsuario  = $( ".wrapper .formulario input[ name='imgusuario' ]" ).val();
											
						if ( nomUsuario.length === 0 ) {
							mensaje+= "<p>El nombre del usuario está vacío.</p>";
							retorno = false;
						}
						if ( nomUsuario.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en el nombre del usuario.</p>";
							retorno = false;
						}						
						if ( apeUsuario.length === 0 ) {
							mensaje+= "<p>La descripción de la raza está vacío.</p>";
							retorno = false;
						}
						if ( apeUsuario.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en la descripción de la raza.</p>";
							retorno = false;
						}
						if ( imgUsuario.length === 0 ) {
							mensaje+= "<p>La imagen no puede quedar vacía.</p>";
							retorno = false;
						} 						
						if ( !retorno ) {
							layermsg.innerHTML = mensaje;
						}												
						if ( retorno ) {
							
							datos =	{	"accion"        : "insUsuario", 
										"nomusuario"    : nomUsuario, 
										"apellidos"     : apeUsuario, 
										"dni"           : dniUsuario,  
										"email"         : mailUsuario,
										"contrasena"    : passUsuario,
										"fecnacimiento" : fecUsuario, 
										"telefono"      : telUsuario,
										"fecalta"       : altaUsuario,
										"imgusuario"    : imgUsuario
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
									$( "table#users tbody tr td:nth-child( 2 ) a" ).each( function( index ) {
										if ( $( this ).text() > nomUsuario && !bInsertado ) {
											nodoPadre = $( this ).parent().parent();
											$( data.trim() ).insertBefore( nodoPadre );											
											bInsertado = true;
										}										
									});

									if ( !bInsertado ) { // inserto.
										$( data.trim() ).insertBefore( "table#users tbody tr:last-child" );
									}																		
									// Limpiar los campos del formulario.
									$( "input[ name='nomusuario' ]" ).val( "" );
									$( "input[ name='apellidos' ]" ).val( "" );
									$( "input[ name='dni' ]" ).val( "" );
									$( "input[ name='email' ]" ).val( "" );
									$( "input[ name='contrasena' ]" ).val( "" );
									$( "input[ name='fecnacimiento' ]" ).val( "" );
									$( "input[ name='telefono' ]" ).val( "" );
									$( "input[ name='fecalta' ]" ).val( "" );
									$( "input[ name='imgusuario' ]" ).val( "" );
								
									$( ".wrapper" ).trigger( "click" );									
									clickNameUser();									
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
				echo $arTableUsers[1];
				echo $arTableUsers[ 2 ];
			?>	
		</div>				
		<div class='overlay ocultoD'>
			<div class='subwrapper'>
				HAS PULSADO EN: <span id='nameuser'></span>
			</div>
		</div>		
		<a class="enlace" href='#altausuario'>Dar de alta usuario nuevo.</a>
		<div class='wrapper ocultoDI'>
			<div class='formulario'>
				<h2>Alta de Usuario</h2>	
				<div class='form'>
					<div> 
						<input type='text' name='nomusuario' placeholder='Nombre' maxlength='30' />
					</div>
					<div> 
						<input type='text' name='apellidos' placeholder='Apellidos' maxlength='50' />
					</div>
					<div> 
						<input type='text' name='dni' placeholder='DNI' maxlength='9' />
					</div>
					<div> 
						<input type='text' name='email' placeholder='Email' maxlength='30' />
					</div>
					<div> 
						<input type='text' name='contrasena' placeholder='Contraseña' maxlength='30' />
					</div>
					<div> 
						Fecha de nacimiento<input type='date' name='fecnacimiento' placeholder='Fecha de nacimiento' maxlength='50' />
					</div>
					<div> 
						<input type='text' name='telefono' placeholder='Teléfono' maxlength='20' />
					</div>
					<div> 
						Fecha de alta<input type='date' name='fecalta' placeholder='Fecha de alta' maxlength='30' />
					</div>
					<div> 
						<input type='text' name='imgusuario' placeholder='Imagen' maxlength='50' />
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