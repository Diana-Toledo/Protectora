<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Razas</title>
		<link rel='stylesheet' href='css/style.css'>
		<link rel="stylesheet" href="css/overlay.css">
		<link rel='stylesheet' href='css/form.css'>	
		<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
		<script src="jquery/jquery-3.6.0.js"></script>

		<script>
			function clickNameRace() {
				$( "table#races tbody td:nth-child( 2 )" ).off( "click" );
				$( "table#races tbody td:nth-child( 2 )" ).on( { 
					"click": function( event ) {
						event.stopPropagation();						
						if ( event.target.nodeName === "TD" ) {
							$( "#namerace" ).html( $( this ).children( "a" ).html() );
							$( ".overlay" ).removeClass( "ocultoD" );
						}					
					}
				});
			}		

			$( function() {				
				clickNameRace();
				
				$( ".overlay" ).on( { 
					"click": function( event ) {
						event.stopPropagation();
						$( this ).addClass( "ocultoD" );
						// Es lo mismo que la anterior. $( ".overlay" ).addClass( "ocultoD" );
					}
					
				});
				
				$( "a[ href='#altaraza' ]" ).on( { 
					"click": function( event ) {
						event.preventDefault(); // Evita que la etiqueta a se vaya al controlador.
						
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
						let nomRaza = $( ".wrapper .formulario input[ name='nomraza' ]" ).val();
						let imgRaza = $( ".wrapper .formulario input[ name='imgraza' ]" ).val();
						let desRaza = $( ".wrapper .formulario textarea[ name='desraza' ]" ).val();
						let idTipo  = $( ".wrapper .formulario select[ name='idtipo' ]" ).val();
						let nomTipo = $( "select[ name='idtipo' ] option:selected" ).text();
											
						if ( nomRaza.length === 0 ) {
							mensaje+= "<p>El nombre de la raza está vacío.</p>";
							retorno = false;
						}
						if ( nomRaza.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en el nombre de la raza.</p>";
							retorno = false;
						}
						if ( imgRaza.length === 0 ) {
							mensaje+= "<p>La imagen no puede quedar vacía.</p>";
							retorno = false;
						}
						if ( desRaza.length === 0 ) {
							mensaje+= "<p>La descripción de la raza está vacío.</p>";
							retorno = false;
						}
						if ( desRaza.trim().length === 0 ) {
							mensaje+= "<p>No puedes teclear solo espacios en blanco en la descripción de la raza.</p>";
							retorno = false;
						} 
						if ( idTipo === "-1" ) {
							mensaje+= "<p>Debe de seleccionar una de los tipos. Utilice el desplegable.</p>";
							retorno = false;
						} 
						
						if ( !retorno ) {
							layermsg.innerHTML = mensaje;
						}
						
						
						if ( retorno ) {
							// La validación es correcta.
							// Hay que mandar los datos al servidor. $.ajax.
							
							datos =	{	"accion" : "insRaza", 
										"nomraza" : nomRaza, 
										"imgraza" : imgRaza, 
										"desraza" : desRaza,  
										"idtipo" : idTipo,
										"nomtipo" : nomTipo 
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
									$( "table#races tbody tr td:nth-child( 2 ) a" ).each( function( index ) {
										
										if ( $( this ).text() > nomRaza && !bInsertado ) {
											nodoPadre = $( this ).parent().parent();
											$( data.trim() ).insertBefore( nodoPadre );											
											bInsertado = true;
										}																			
									});
									if ( !bInsertado ) { // inserto.
										$( data.trim() ).insertBefore( "table#races tbody tr:last-child" );
									}
									$( "input[ name='nomraza' ]" ).val( "" );
									$( "input[ name='imgraza' ]" ).val( "" );
									$( "textarea[ name='desraza' ]" ).val( "" );
									$( "select[ name='idtipo' ]" ).val( "-1" );
									$( ".wrapper" ).trigger( "click" );									
									clickNameRace();									
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
			echo $arTableRaces[ 1 ];
			echo $arTableRaces[ 2 ];
		?>		
		</div>		
		<div class='overlay ocultoD'>
			<div class='subwrapper'>
				HAS PULSADO EN: <span id='namerace'></span>
			</div>
		</div>		
		<a class="enlace" href='#altaraza'>Dar de alta Raza nueva.</a>
		
		<div class='wrapper ocultoDI'>
			<div class='formulario'>
				<h2>Alta de Raza</h2>		
				<div class='form'>
					<div> 
						<input type='text' name='nomraza' placeholder='Nombre de la raza' maxlength='30' />
					</div>
					<div> 
						<input type='text' name='imgraza' placeholder='Imagen raza' maxlength='50' />
					</div>
					<div> 
						<textarea name='desraza' placeholder='Descripción raza'></textarea>
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