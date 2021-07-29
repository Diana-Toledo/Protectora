<?php
	require ( "../lib/mod004_presentacion.php" );

	$accion = $_POST[ "accion" ];
	
	switch ( $accion ) {
		case "getHistorialAnimal":
			if ( isset( $_POST[ "idAnimal" ] ) ) {
				$idAnimal = $_POST[ "idAnimal" ];
				
				$dataReturn = mod004_getHistorialAnimal( $idAnimal );
				
				echo json_encode( $dataReturn );
				
			} else {
				
			}
		break;
		case "getPhotoAnimal":
			if ( isset( $_POST[ "idAnimal" ] ) ) {
				$idAnimal = $_POST[ "idAnimal" ];
				
				$dataReturn = mod004_getPhotoAnimal( $idAnimal );
				
				echo json_encode( $dataReturn );
				
			} else {
				
			}
		break;
		case "insRaza":
			if ( isset( $_POST[ "nomraza" ], 
						$_POST[ "imgraza" ], 
						$_POST[ "desraza" ], 
						$_POST[ "idtipo" ], 
						$_POST[ "nomtipo" ] ) ) {
				$nomraza = $_POST[ "nomraza" ];
				$imgraza = $_POST[ "imgraza" ];
				$desraza = $_POST[ "desraza" ];
				$idtipo = $_POST[ "idtipo" ];
				$nomtipo = $_POST[ "nomtipo" ];
				
				$dataReturn = mod004_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo, $nomtipo );
				
				echo $dataReturn;
				
			} else {
				
			}
		break;
		case "insUsuario":
			if ( isset( $_POST[ "nomusuario" ], 
						$_POST[ "apellidos" ], 
						$_POST[ "dni" ], $_POST[ "email" ], 
						$_POST[ "contrasena" ], $_POST[ "fecnacimiento" ], 
						$_POST[ "telefono" ], $_POST[ "fecalta" ], 
						$_POST[ "imgusuario" ] ) ) {
				$nomusuario   = $_POST[ "nomusuario" ];
				$apeusuario   = $_POST[ "apellidos" ];
				$dnisuario    = $_POST[ "dni" ];
				$emailusuario = $_POST[ "email" ];
				$passusuario  = $_POST[ "contrasena" ];
				$fecusuario   = $_POST[ "fecnacimiento" ];
				$telusuario   = $_POST[ "telefono" ];
				$altausuario  = $_POST[ "fecalta" ];
				$imgusuario   = $_POST[ "imgusuario" ];
				
				$dataReturn = mod004_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario );
				
				echo $dataReturn;
				
			} else {
				
			}
		break;
		case "insAnimal":
			if ( isset( $_POST[ "nomanimal" ], 
						$_POST[ "sexo" ], $_POST[ "anionacimiento" ], 
						$_POST[ "imganimal" ], $_POST[ "peso" ], 
						$_POST[ "altura" ], $_POST[ "desanimal" ], 
						$_POST[ "idraza" ], $_POST[ "nomraza" ] ) ) {
				$nomanimal = $_POST[ "nomanimal" ];
				$sexo = $_POST[ "sexo" ];
				$anionacimiento = $_POST[ "anionacimiento" ];
				$imganimal = $_POST[ "imganimal" ];
				$peso = $_POST[ "peso" ];
				$altura = $_POST[ "altura" ];
				$desanimal = $_POST[ "desanimal" ];
				$idraza = $_POST[ "idraza" ];
				$nomraza = $_POST[ "nomraza" ];				
				$dataReturn = mod004_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza, $nomraza );
				
				echo $dataReturn;
				
			} else {
				
			}
		break;
		case "actUser":
			if ( isset( $_POST[ "idusuario" ],
						$_POST[ "nomusuario" ], 
						$_POST[ "apellidos" ], 
						$_POST[ "dni" ], 
						$_POST[ "imgusuario" ] ) ) {						
				$idusuario	   = $_POST[ "idusuario" ];
				$nomusuario	   = $_POST[ "nomusuario" ]; 
				$apellidos	   = $_POST[ "apellidos" ]; 
				$dni           = $_POST[ "dni" ]; 
				$imgusuario    = $_POST[ "imgusuario" ];				 
								
				$dataReturn = mod004_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario );				
				echo json_encode( $dataReturn );
				
			} 
		break;
		case "actAnimal":
			if ( isset( $_POST[ "idanimal" ],
						$_POST[ "nomanimal" ], 
						$_POST[ "sexo" ], 
						$_POST[ "imganimal" ], 
						$_POST[ "fecencontrado" ],
						$_POST[ "lugarencontrado" ],
						$_POST[ "idraza" ] ) ) {						
				$idanimal		 = $_POST[ "idanimal" ];
				$nomanimal		 = $_POST[ "nomanimal" ]; 
				$sexo		     = $_POST[ "sexo" ]; 
				$imganimal		 = $_POST[ "imganimal" ];
				$fecencontrado	 = $_POST[ "fecencontrado" ];
				$lugarencontrado = $_POST[ "lugarencontrado" ];				 
				$idraza		     = $_POST[ "idraza" ];
				
				$dataReturn = mod004_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza );				
				echo json_encode( $dataReturn );
				
			} else {

			}
		break;
		default:
		}
 

