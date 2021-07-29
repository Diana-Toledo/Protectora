<?php
	require ( "mod003_logica.php" );

	/** 
	mod004_getUserById( $idUsuario )

		-- Descripción larga --
			Esta función crea el html correspondiente en este caso formato card a un usuario en concreto con todos sus datos imagen, nombre, DNI,
			Fecha de nacimiento, emai, contraseña, teléfono, fecha de alta.
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arTableUsers              : Esta variable develve un array con la información de la card.
		-- Funciones a la que llama.
			mod003_getUserById( $idUsuario )
		-- funciones que la llaman.
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod004_getUserById( $idUsuario ) {
		$arDataUsers = mod003_getUserById( $idUsuario );

		switch ( $arDataUsers[ "status" ][ "codError"] ) {
			case "000":
				$tableUsers = "<div id='users' class='contenido'>";
				for ( $i = 0; $i < count ( $arDataUsers[ "data" ]  ); $i++ ){ 					
					$tableUsers.= "<div class='tarjeta'>"; 
						$tableUsers.= "<img src=" . $arDataUsers[ "data" ][ $i ] [ "imgusuario" ] . ">";
						$tableUsers.= "<p data-id='{$arDataUsers[ "data" ][ $i ] [ "idusuario" ]}'>" . $arDataUsers[ "data" ][ $i ] [ "nomusuario" ] . "</p>";
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "apellidos" ] . "</p>";						
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "dni" ] . "</p>";
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "fecnacimiento" ] . "</p>";
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "email" ] . "</p>";			
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "contrasena" ] . "</p>";
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "telefono" ] . "</p>";	
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "fecalta" ] . "</p>";
						$tableUsers.= "<p>" . $arDataUsers[ "data" ][ $i ] [ "imgusuario" ] . "</p>";
						$tableUsers.= "<p class='editar'>" . "Editar" . "</p>";
						$tableUsers.= "</div>";			
					if ( $i % 3 === 2 ) {
					$tableUsers.= "</div>";
					}
				}			
				$tableUsers.= "</div";
		break;
		case "001": // Sino tengo datos.
				$tableUsers = "<table>
									<thead>
										<tr>									
											<th>NOMBRE</th>
											<th>APELLIDOS</th>
											<th>DNI</th>
											<th>EMAIL</th>
											<th>CONTRASEÑA</th>
											<th>FECNACIMIENTO</th>
											<th>TELÉFONO</th>
											<th>FECALTA</th>
											<th>IMAGEN</th>								
										</tr>
									</thead>
									<tbody><tr><td colspan='9'>Sin datos.</td></tr></tbody>
								</table>";																
		break;
		case "002":
			$tableUsers = "<div>query: " . $arDataUsers[ "status" ][ "strSQL" ] . "</div>";
			$tableUsers.= "<div>Cod.Error: " . $arDataUsers[ "status" ][ "codErrorSQL" ] . "</div>";
			$tableUsers.= "<div>Des.Error:" . $arDataUsers[ "status" ][ "desErrorSQL" ] . "</div>";
		break;
		default:		
		}
		$arTableUsers[ 0 ] = $arDataUsers[ "status" ][ "codError" ];
		$arTableUsers[ 1 ] = $tableUsers;
		
		return $arTableUsers;
	}
	/** 
	mod004_getUserPagination( $pag, $numRegistros )

	-- Descripción larga --
		Esta función crea el html correspondiente a la paginación en este caso formato tabla con nombre, apellidos, fecha de nacimiento y fecha de alta.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableUsers              : Esta variable develve un array con la información de la tabla y su sistema de paginación.
	-- Funciones a la que llama.
		mod003_getUserPagination( $pag, $numRegistros );
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
// PAGINACIÓN
	function mod004_getUserPagination( $pag, $numRegistros ) {
		$arDataUsers = mod003_getUserPagination( $pag, $numRegistros );

		switch ( $arDataUsers[ "status" ][ "codError"] ) {
			case "000":
				$tableUsers = "<table id='users'>
									<thead>
										<tr>
											<th>NOMBRE</th>
											<th>APELLIDOS</th>										
											<th>FECNACIMIENTO</th>										
											<th>FECALTA</th>										
										</tr>	
									</thead>
									<tbody>";
				for ( $i = 0; $i < count ( $arDataUsers[ "data" ]  ); $i++ ){
					$tableUsers.= "<tr>"; 
					foreach ( $arDataUsers[ "data" ][ $i ] as $clave => $valor ) {
						if ( $clave === "idusuario" ) {
							$idUsuario = $valor;
						} else {
							if ( $clave === "nomusuario" ) {
								$tableUsers.= "<td><a href='verusuario?idusuario=" . $arDataUsers[ "data" ][ $i ] [ "idusuario" ]."'>" . $arDataUsers[ "data" ][ $i ] [ "nomusuario" ] . "</a>" . "</h4>";
								$tableUsers.= "<td>" . $arDataUsers[ "data" ][ $i ] [ "apellidos" ] ."</td>";
								$tableUsers.= "<td>" . $arDataUsers[ "data" ][ $i ] [ "fecnacimiento" ] ."</td>";
								$tableUsers.= "<td>" . $arDataUsers[ "data" ][ $i ] [ "fecalta" ] ."</td>";
							} 
						}
					}
					$tableUsers.= "</tr>";
				}
					$tableUsers.= "</tbody>";
				$tableUsers.= "</table>";
			
			break;
			case "001": // Sino tengo datos.
					$tableUsers = "<table>
										<thead>
											<tr>									
												<th>NOMBRE</th>
												<th>APELLIDOS</th>										
												<th>FECNACIMIENTO</th>										
												<th>FECALTA</th>								
											</tr>
										</thead>
										<tbody><tr><td colspan='4'>Sin datos.</td></tr></tbody>
									</table>";																
			break;
			case "002":
				$tableUsers = "<div>query: " . $arDataUsers[ "status" ][ "strSQL" ] . "</div>";
				$tableUsers.= "<div>Cod.Error: " . $arDataUsers[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableUsers.= "<div>Des.Error:" . $arDataUsers[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:		
		}
		$arTableUsers[ 0 ] = $arDataUsers[ "status" ][ "codError" ];
		$arTableUsers[ 1 ] = $tableUsers;
		
		$totalPaginas = mod003_getUserTotal( $numRegistros );
		$arTableUsers[ 2 ] = "";
		
		$bPrimeraVez = false;
		$arTableUsers[ 2 ].= "<div>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) {
			if ( !$bPrimeraVez ) {
				$bPrimeraVez = true;
				$arTableUsers[ 2 ].= "<ul class='paginacion'>";
				$arTableUsers[ 2 ].= "<li>" . "<a href='usuarios'>$i</a>" . "</li>";	
			} else {
				$arTableUsers[ 2 ].= "<li>". "<a href='usuarios?pag=$i'>$i</a>" . "</li>";	
			}
		}
		if ( $pag !== floatval( 1 ) ) {
			$arTableUsers[ 2 ].= "<li>" . "<a href='usuarios?t=$numRegistros'><<</a>" . "</li>";
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagAnt = $pag - 1;
			} else {
				$pagAnt = floor( $pag );
			}	
				
			$arTableUsers[ 2 ].= "<li>" . "<a href='usuarios?pag=$pagAnt&t=$numRegistros'><</a>" . "</li>";;
		} else {
			$arTableUsers[ 2 ].= "<< <";
		}
		
		if ( $pag - floor( $pag ) === floatval( 0 ) ) {
			$arTableUsers[ 2 ].= " $pag";
		} else {
			$arTableUsers[ 2 ].= " ?? " ;
		}	
		
		if ( $pag < $totalPaginas ) {
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagSig = $pag + 1;
			} else {
				$pagSig = floor( $pag ) + 1;
			}
			$arTableUsers[ 2 ].= "<li>" . "<a href='usuarios?pag=$pagSig&t=$numRegistros'>></a>" . "</li>";;
			$arTableUsers[ 2 ].= "<li>" . "<a href='usuarios?pag=$totalPaginas&t=$numRegistros'>>></a>" . "</li>";;
		} else {
			$arTableUsers[ 2 ].= " > >>";
			$arTableUsers[ 2 ].= "</ul>";
			$arTableUsers[ 2 ].="</div>";
		}
		return $arTableUsers;
	}
	/** 
	mod004_insertHighUser()

	-- Descripción larga --
		Esta función cuando se inserta un usuario crea un tr con td nombre, apellidos, fecha de nacimiento y fecha de alta.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$layer             : Esta variable develve un array con la información de la tabla.
	-- Funciones a la que llama.
		mod003_insertHighUser()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario ) {
		$layer = "";
		$arInsAltaUsuario = mod003_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario );
		
		$layer.= "<tr>";
		$layer.= 	"<td>";
		$layer.=        "<a href='verusuario?idusuario=" . $arInsAltaUsuario[ "data" ][ 0 ][ "idUserNew" ] . "'>$nomusuario</a>";
		$layer.= 	"</td>";
		$layer.= 	"<td>";
		$layer.= 	   	 $apeusuario;
		$layer.= 	"</td>";
		$layer.= 	"<td>";
		$layer.= 	   	 $fecusuario;
		$layer.= 	"</td>";
		$layer.= 	"<td>";
		$layer.= 	   	$altausuario;
		$layer.= 	"</td>";
		$layer.= "</tr>";
		
		return $layer;		
	}

	/** 
	mod004_getRacePagination( $pag, $numRegistros )

	-- Descripción larga --
		Esta función creamos el html de la paginación de las razas en formato tabla con el nombre de la raza( enlace ) y tipo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableRaces              : Esta variable develve un array con la información de la tabla y su sistema de paginación.
	-- Funciones a la que llama.
		mod003_getRacePagination( $pag, $numRegistros )
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getRacePagination( $pag, $numRegistros ) {
		$arDataRaces = mod003_getRacePagination( $pag, $numRegistros );

		switch ( $arDataRaces[ "status" ][ "codError"] ) {
			case "000":

				$tableRaces = "<table id='races'>
								<thead>
									<tr>
										<th>NOMRAZA</th>										
										<th>NOMTIPO</th>				
									</tr>
								</thead>
								<tbody>";
				
							for ( $i = 0; $i < count ( $arDataRaces[ "data" ]  ); $i++ ){ // recorre cada animal
								$tableRaces.= "<tr>"; 
								foreach ( $arDataRaces[ "data" ][ $i ] as $clave => $valor ) {
									if ( $clave === "idraza" ) {
										$idRaza = $valor;
									} else {
										if ( $clave === "nomraza" ) {
											$tableRaces.= "<td><a href='verraza?idraza=" . $arDataRaces[ "data" ][ $i ] [ "idraza" ]."'>" . $arDataRaces[ "data" ][ $i ] [ "nomraza" ] . "</a>" . "</h4>";
										} else {
											$tableRaces.= "<td>";
											$tableRaces.= $valor;					
										}
										$tableRaces.= "</td>";				
									}
								}
								
						$tableRaces.= "</tr>";
							}
								$tableRaces.= "</tbody>";
							$tableRaces.= "</table>";

			break;	
			case "001": // Sino tengo datos.
					$tableRaces = "<table>
										<thead>
											<tr>
												<th>NOMRAZA</th>
												<th>NOMTIPO</th>
											</tr>
										</thead>
										<tbody><tr><td colspan='2'>Sin datos.</td></tr></tbody>
									</table>";								
									
			break;
			case "002":
				$tableRaces = "<div>query: " .$arDataRaces[ "status" ][ "strSQL" ] . "</div>";
				$tableRaces.= "<div>Cod.Error: " .$arDataRaces[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableRaces.= "<div>Des.Error:" .$arDataRaces[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:		
		}
		$arTableRaces[ 0 ] = $arDataRaces[ "status" ][ "codError" ];
		$arTableRaces[ 1 ] = $tableRaces;
		
		$totalPaginas = mod003_getRaceTotal( $numRegistros );
		$arTableRaces[ 2 ] = "";
		
		$bPrimeraVez = false;
		$arTableRaces[ 2 ].= "<div>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) {
			if ( !$bPrimeraVez ) {
				$bPrimeraVez = true;
				$arTableRaces[ 2 ].= "<ul class='paginacion'>";
				$arTableRaces[ 2 ].= "<li>" . "<a href='razas'>$i</a>" . "</li>";	
			} else {
				$arTableRaces[ 2 ].= "<li>" . "<a href='razas?pag=$i'>$i</a>" . "</li>";	
			}
		}

		if ( $pag !== floatval( 1 ) ) {
			$arTableRaces[ 2 ].= "<li>" . "<a href='razas?t=$numRegistros'><<</a>" . "</li>"; // < &lt; less than
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagAnt = $pag - 1;
			} else {
				$pagAnt = floor( $pag );
			}	
				
			$arTableRaces[ 2 ].= "<li>" . "<a href='razas?pag=$pagAnt&t=$numRegistros'><</a>" . "</li>";
		} else {
			$arTableRaces[ 2 ].= "<< <";
		}
		
		if ( $pag - floor( $pag ) === floatval( 0 ) ) {
			$arTableRaces[ 2 ].= " $pag";
		} else {
			$arTableRaces[ 2 ].= " ?? " ;
		}	
		
		if ( $pag < $totalPaginas ) {
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagSig = $pag + 1;
			} else {
				$pagSig = floor( $pag ) + 1;
			}
			$arTableRaces[ 2 ].= "<li>" . "<a href='razas?pag=$pagSig&t=$numRegistros'>></a>" . "</li>";
			$arTableRaces[ 2 ].= "<li>" . "<a href='razas?pag=$totalPaginas&t=$numRegistros'>>></a>" . "</li>";
		} else {
			$arTableRaces[ 2 ].= " > >>";
			$arTableRaces[ 2 ].= "</ul>";
			$arTableRaces[ 2 ].="</div>";
	}
		return $arTableRaces;
}

	/** 
	mod004_getAnimalsById( $idAnimal )

	-- Descripción larga --
		Esta función crea el html correspondiente a un animal en concreto en este caso formato tabla.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableAnimals              : Esta variable develve un array con la información de la tabla.
	-- Funciones a la que llama.
		mod003_getAnimalsById( $idAnimal )
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
						// ANIMALES

	// una vez que pulso el link de cada animal me muestra cada animal con todos sus datos
	function mod004_getAnimalsById( $idAnimal ) {
		$arDataAnimals = mod003_getAnimalsById( $idAnimal );
		//print_r( $arDataAnimals );
		switch ( $arDataAnimals[ "status" ][ "codError"] ) {
			case "000":
					$tableAnimals = "<table id='listanimales'>
										<thead>
											<tr>
												<th>NOMBRE</th>																							
												<th>SEXO</th>
												<th>AÑO DE NACIMIENTO</th>
												<th>IMAGEN</th>
												<th>PESO</th>
												<th>ALTURA</th>									
												<th>RAZA</th>
												<th>FENCONTRADO</th>
												<th>LENCONTRADO</th>
												<th>ACCIÓN</th>
											</tr>
										</thead>
										<tbody>";
								for ( $i = 0; $i < count ( $arDataAnimals[ "data" ]  ); $i++ ){ // recorre cada animal
									$tableAnimals.= "<tr>"; 
									foreach ( $arDataAnimals[ "data" ][ $i ] as $clave => $valor ) {							
										if ( $clave === "idanimal" ) {
											$idAnimal = $valor;
										} else {
											if ( $clave === "nomanimal" ) {
												$tableAnimals.= "<td data-id='$idAnimal'>";
													$tableAnimals.= "<strong>$valor</strong>";
													
											} else {
												$tableAnimals.= "<td>";
													$tableAnimals.= $valor;					
											}							
											$tableAnimals.= "</td>";											
										}
									}
									$tableAnimals.= "<td class='editar'>";
										$tableAnimals.= "Editar";
									$tableAnimals.= "</td>";
								$tableAnimals.= "</tr>";								
								}
							$tableAnimals.= "</tbody>";
					$tableAnimals.= "</table>";
			break;		
			case "001": // Sino tengo datos.
				$tableAnimals = "<table>
									<thead>
										<tr>
										<th>NOMBRE</th>																							
										<th>SEXO</th>
										<th>AÑO DE NACIMIENTO</th>
										<th>IMAGEN</th>
										<th>PESO</th>
										<th>ALTURA</th>									
										<th>RAZA</th>
										<th>FENCONTRADO</th>
										<th>LENCONTRADO</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='9'>Sin datos.</td></tr></tbody>
								</table>";
			break;
			case "002":
				$tableAnimals = "<div>query: " . $arDataAnimals[ "status" ][ "strSQL" ] . "</div>";
				$tableAnimals.= "<div>Cod.Error: " . $arDataAnimals[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableAnimals.= "<div>Des.Error:" . $arDataAnimals[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:		
		}
		$arTableAnimals[ 0 ] = $arDataAnimals[ "status" ][ "codError" ];
		$arTableAnimals[ 1 ] = $tableAnimals;
		
		return $arTableAnimals;
	}

	/** 
	mod004_updateAnimal()

	-- Descripción larga --
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod003_updateAnimal()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza ) {
		$arDataAnimal = mod003_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza );	
		
		return $arDataAnimal;
	}

	/** 
	mod004_getAnimalsByNameRace( $idRaza)

	-- Descripción larga --
		Esta función crea el html correspondiente a un animal o animales que pertenezcan a una raza en concreto en este caso formato card con la
		imagen y el nombre.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableAnimals              : Esta variable develve un array con la información de la tabla.
	-- Funciones a la que llama.
		mod003_getAnimalsByNameRace( $idRaza)
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getAnimalsByNameRace( $idRaza) {	
		$arDataAnimals = mod003_getAnimalsByNameRace( $idRaza);
		
		switch ( $arDataAnimals[ "status" ][ "codError"] ) {
			case "000":
				$tableAnimals = "<div id='listanimales' class='contenedor'>";
							for ( $i = 0; $i < count ( $arDataAnimals[ "data" ]  ); $i++ ) { // recorre cada animal
								if ( $i % 3 === 0 ) {
									$tableAnimals.= "<div class='filas'>";
								}
								$tableAnimals.= "<div class='tarjeta'>"; 
										$tableAnimals.= "<img src=" . $arDataAnimals[ "data" ][ $i ] [ "imganimal" ] . ">";
										$tableAnimals.= "<h4>" . $arDataAnimals[ "data" ][ $i ] [ "nomanimal" ] . "</h4>";
								$tableAnimals.= "</div>";
								if ( $i % 3 === 2 ) {
									$tableAnimals.= "</div>";
								}
							}					
			break;
			case "001": // Sino tengo datos.
				$tableAnimals = "<table>
									<thead>
										<tr>
											<th>IMAGEN</th>
											<th>NOMBRE</th>										
										</tr>
									</thead>
									<tbody><tr><td colspan='2'>Sin datos.</td></tr></tbody>
								</table>";
			break;
			case "002":
				$tableAnimals = "<div>query: " . $arDataAnimals[ "status" ][ "strSQL" ] . "</div>";
				$tableAnimals.= "<div>Cod.Error: " . $arDataAnimals[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableAnimals.= "<div>Des.Error:" . $arDataAnimals[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:		
		}
		$arTableAnimals[ 0 ] = $arDataAnimals[ "status" ][ "codError" ];
		$arTableAnimals[ 1 ] = $tableAnimals;
	
		return $arTableAnimals;
	}


	// Tabla de animales para paginación
	/** 
	mod004_getAnimalPagination( $pag, $numRegistros )

	-- Descripción larga --
		Esta función crea el html correspondiente a la paginación de los animales que se visualizan en cada página en formato card.
		imagen y el nombre.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableAnimals              : Esta variable develve un array con la información de la card y su sistema de paginación.
	-- Funciones a la que llama.
		mod003_getAnimalPagination( $pag, $numRegistros )
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getAnimalPagination( $pag, $numRegistros ) {
		$arDataAnimals = mod003_getAnimalPagination( $pag, $numRegistros );

		switch ( $arDataAnimals[ "status" ][ "codError"] ) {
			case "000":
				$tableAnimals = "<div id='listanimales' class='contenedor'>";
							for ( $i = 0; $i < count ( $arDataAnimals[ "data" ]  ); $i++ ) {
								if ( $i % 3 === 0 ) {
									$tableAnimals.= "<div class='filas'>";
								}
								$tableAnimals.= "<div class='tarjeta'>"; 
									$tableAnimals.= "<img src=" . $arDataAnimals[ "data" ][ $i ] [ "imganimal" ] . ">";
									$tableAnimals.= "<h4><a href='veranimal?idanimal=" . $arDataAnimals[ "data" ][ $i ] [ "idanimal" ] . "'>" . $arDataAnimals[ "data" ][ $i ] [ "nomanimal" ] . "</a>" . "</h4>";						
								$tableAnimals.= "</div>";
								if ( $i % 3 === 2 ) {
									$tableAnimals.= "</div>";
									$tableAnimals.= "<div>";
								}		
							}
							
				$tableAnimals.= "</div";
			break;	
			case "001": // Sino tengo datos.
				$tableAnimals = "<table>
									<thead>
										<tr>
											<th>IMAGENL</th>
											<th>NOMBRE</th>
										</tr>
									</thead>
									<tbody><tr><td colspan='2'>Sin datos.</td></tr></tbody>
								</table>";																
			break;
			case "002":
				$tableAnimals = "<div>query: " . $arDataAnimals[ "status" ][ "strSQL" ] . "</div>";
				$tableAnimals.= "<div>Cod.Error: " . $arDataAnimals[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableAnimals.= "<div>Des.Error:" . $arDataAnimals[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:		
		}
		$arTableAnimals[ 0 ] = $arDataAnimals[ "status" ][ "codError" ];
		$arTableAnimals[ 1 ] = $tableAnimals;
		
		$totalPaginas = mod003_getAnimalTotal( $numRegistros );
		$arTableAnimals[ 2 ] = "";
		
		$bPrimeraVez = false;
		$arTableAnimals[ 2 ].= "<div>";
		for ( $i = 1; $i <= $totalPaginas; $i++ ) {
			if ( !$bPrimeraVez ) {
				$bPrimeraVez = true;
				$arTableAnimals[ 2 ].= "<ul class='paginacion'>";
				$arTableAnimals[ 2 ].= "<li>" . "<a href='animales'>$i</a>" . "</li>";	
			} else {	
				$arTableAnimals[ 2 ].= "<li>" . "<a href='animales?pag=$i'>$i</a>" . "</li>";	
			}
		}
		if ( $pag !== floatval( 1 ) ) {
			$arTableAnimals[ 2 ].= "<li>" . "<a href='animales?t=$numRegistros'><<</a>" . "</li>";
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagAnt = $pag - 1;
			} else {
				$pagAnt = floor( $pag );
			}	
				
			$arTableAnimals[ 2 ].= "<li>" . " <a href='animales?pag=$pagAnt&t=$numRegistros'><</a>" . "</li>";
		} else {
			$arTableAnimals[ 2 ].= "<< <";
		}
		
		if ( $pag - floor( $pag ) === floatval( 0 ) ) {
			$arTableAnimals[ 2 ].= " $pag";
		} else {
			$arTableAnimals[ 2 ].= " ?? " ;
		}	
		
		if ( $pag < $totalPaginas ) {
			if ( $pag - floor( $pag ) === floatval( 0 ) ) {
				$pagSig = $pag + 1;
			} else {
				$pagSig = floor( $pag ) + 1;
			}
			$arTableAnimals[ 2 ].= "<li>" . " <a href='animales?pag=$pagSig&t=$numRegistros'>></a>" . "</li>";
			$arTableAnimals[ 2 ].= "<li>" . " <a href='animales?pag=$totalPaginas&t=$numRegistros'>>></a>" ."</li>";
		} else {
			$arTableAnimals[ 2 ].= " > >>";
			$arTableAnimals[ 2 ].= "</ul";
			$arTableAnimals[ 2 ].="</div>";
	}
		return $arTableAnimals;
	}

	/** 
	mod004_insertHighAnimal()

	-- Descripción larga --
		Esta función cuando se inserta un animal crea un tr con td nombre.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$layer             : Esta variable develve un array con la información de la tabla..
	-- Funciones a la que llama.
		mod003_insertHighAnimal()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/	
	function mod004_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza, $nomraza ) {
		$layer = "";		
		$arInsAltaAnimal = mod003_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza );
		
		$layer.= "<tr>";		
		$layer.= 	"<td>";
		$layer.= 	   	$arInsAltaAnimal[ "data" ][ 0 ][ "idAnimalNew" ];
		$layer.= 	"</td>";		
		$layer.= 	"<td>";
		$layer.=        $arInsAltaAnimal[ "data" ][ 0 ][ "idAnimalNew" ] . $nomanimal;
		$layer.= 	"</td>";
		$layer.= "</tr>";

		return $layer;		
	}

		/** 
	mod004_insertHighRace()

	-- Descripción larga --
		Esta función cuando se inserta una raza crea un tr con dos td nombre de la raza y nombre del tipo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$layer             : Esta variable develve un array con la información de la tabla..
	-- Funciones a la que llama.
		mod003_insertHighRace()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/	
	
	function mod004_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo, $nomtipo ) {
		$layer = "";
		
		$arInsAltaRaza = mod003_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo );		
		$layer.= "<tr>";
		$layer.= 	"<td>";
		$layer.=    	"<a href='verraza?idraza=" . $arInsAltaRaza[ "data" ][ 0 ][ "idRaceNew" ] . "'>$nomraza</a>";		
		$layer.= 	"</td>";
		$layer.= 	"<td>";
		$layer.= 	   	$nomtipo;
		$layer.= 	"</td>";
		$layer.= "</tr>";
		
		return $layer;		
	}

	/** 
	mod004_getSelectType()

	-- Descripción larga --
		Esta función crea el html correspondiente al input del campo select que selecciona el tipo de una raza.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod003_getSelectType()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/

	
	function mod004_getSelectType() {
		$arDataTipos = mod003_getSelectType();
		
		switch ( $arDataTipos[ "status" ][ "codError" ] ) {
			case "000":
				$layerSelect = "";
				$layerSelect.= "<select name='idtipo'>";
				$layerSelect.= "<option value='-1'>Elige Tipo</option>";
					for ( $i = 0; $i < count( $arDataTipos[ "data" ] ); $i++ ) {
						$layerSelect.= "<option value='" . $arDataTipos[ 'data' ][ $i ][ 'idtipo' ] . "'>" . $arDataTipos[ 'data' ][ $i ][ 'nomtipo' ] . "</option>";
					} 
				$layerSelect.= "</select>";
			break;
		}

		return $layerSelect;		
	}

	/** 
	mod004_getSelectRaces()

	-- Descripción larga --
		Esta función crea el html correspondiente al input de tipo  select que selecciona la raza en el alta de un animal.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod003_getSelectRaces()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getSelectRaces() {
		$arDataRaces = mod003_getSelectRaces();
		
		switch ( $arDataRaces[ "status" ][ "codError" ] ) {
			case "000":
				$layerSelect = "";
				$layerSelect.= "<select name='idraza'>";
				$layerSelect.= "<option value='-1'>Elige Raza</option>";
					for ( $i = 0; $i < count( $arDataRaces[ "data" ] ); $i++ ) {
						$layerSelect.= "<option value='" . $arDataRaces[ 'data' ][ $i ][ 'idraza' ] . "'>" . $arDataRaces[ 'data' ][ $i ][ 'nomraza' ] . "</option>";
					} 
				$layerSelect.= "</select>";
			break;
		}

		return $layerSelect;		
	}

	function mod004_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario ) {
		$arDataUser = mod003_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario );
		return $arDataUser;
	}
	/**
	mod004_getHistorialAnimal()

	-- Descripción larga --
	-- Argumentos --º
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod003_getHistorialAnimal()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/	

	
	function mod004_getHistorialAnimal( $idAnimal ) {
		$arDataHistorial = mod003_getHistorialAnimal( $idAnimal );
		return $arDataHistorial;
	}

	/**
	mod004_getAdoptions()

	-- Descripción larga --
		Esta función crea el html correspondiente a la tabla de los animales en adopción.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arTableUsers              : Esta variable develve un array con la información de la tabla.
	-- Funciones a la que llama.
		mod003_getAdoptions()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getAdoptions(){
		$arDataAdoptions = mod003_getAdoptions();
		
		switch ( $arDataAdoptions[ "status" ][ "codError" ] ) {
			case "000":
				$tableAdoptions = "<table id='listanimales'>
										<thead>
										<div class='titulo'>
											<h4 > Animales en adopción </h4>
											<div class='buscador'>
												<input type='text' placeholder='Búsqueda' class='busqueda' />
											</div>
										</div>
											<tr>
												<th>NOMBRE</th>
												<th>TIPO</th>
												<th>RAZA</th>					
											</tr>
										</thead>
										<tbody>";

							for ( $i = 0; $i < count ( $arDataAdoptions[ "data" ] ); $i++ ) { // Recorre cada una de las filas.				
								$tableAdoptions.= "<tr>";
								foreach ( $arDataAdoptions[ "data" ][ $i ] as $clave => $valor ) { // Recorre las columnas de cada fila, indiferente de si una fila tiene + columnas que otra.
									if ( $clave === "idanimal" ) {
										$idAnimal = $valor;
									} else {
										if ( $clave === "nomanimal" ) {
											$tableAdoptions.= "<td data-id='$idAnimal'>";
												$tableAdoptions.= "<strong>$valor</strong>";
										} else {
											$tableAdoptions.= "<td>";
												$tableAdoptions.= $valor;					
										}
										$tableAdoptions.= "</td>";				
									}
								}
								$tableAdoptions.= "</tr>";
							}
							$tableAdoptions.= "</tbody>";
						$tableAdoptions.= "</table>";
			break;
			case "001":
				$tableAdoptions = "<table>
										<thead>
											<tr>
												<th>NOMBRE</th>
												<th>TIPO</th>
												<th>RAZA</th>						
											</tr>
										</thead>
										<tbody>
											<tr><td colspan='3'>Sin datos.</td></tr></tbody>
									</table>";
			break;
			case "002":
				$tableAdoptions = "<div>query: " . $arDataAdoptions[ "status" ][ "strSQL" ] . "</div>";
				$tableAdoptions.= "<div>Cod.Error: " . $arDataAdoptions[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableAdoptions.= "<div>Des.Error:" . $arDataAdoptions[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:			
		}
		
		$arTableUsers[ 0 ] = $arDataAdoptions[ "status" ][ "codError" ];
		$arTableUsers[ 1 ] = $tableAdoptions;
		
		return $arTableUsers;
	}

	function mod004_getPhotoAnimal( $idAnimal ) {
		$arDataPhotoAnimal = mod003_getPhotoAnimal( $idAnimal );
		
		return $arDataPhotoAnimal;
	}
	/**
	 mod004_getAdoption( $busNombre )
	-- Descripción larga --
		Esta función crea el html correspondiente a la tabla de adopciones con el buscador.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
		$arRetorno              : Esta variable develve un array con la información de la tabla que requerimos en el filtro del buscador..
	-- Funciones a la que llama.
		mod003_getAdoption( $busNombre )
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod004_getAdoption( $busNombre ){
		$arDataAdoptions = mod003_getAdoption( $busNombre );
	
		switch ( $arDataAdoptions[ "status" ][ "codError" ] ) {
			case "000":
				$tableAdoptions = "<table id='listanimales'>
										<thead>
											<h4 class='titulo'> Animales en adopción </h4>
											<div class='buscador'>
												<input type='text' placeholder='Búsqueda' class='busqueda' />
											</div>
											<tr>
												<th>NOMBRE</th>
												<th>TIPO</th>
												<th>RAZA</th>					
											</tr>
										</thead>
										<tbody>";

							for ( $i = 0; $i < count ( $arDataAdoptions[ "data" ] ); $i++ ) { 				
								$tableAdoptions.= "<tr>";
								foreach ( $arDataAdoptions[ "data" ][ $i ] as $clave => $valor ) { 
									if ( $clave === "idanimal" ) {
										$idAnimal = $valor;
									} else {
										if ( $clave === "nomanimal" ) {
											$tableAdoptions.= "<td data-id='$idAnimal'>";
												$tableAdoptions.= "<strong>$valor</strong>";
										} else {
											$tableAdoptions.= "<td>";
												$tableAdoptions.= $valor;					
										}
										$tableAdoptions.= "</td>";				
									}
								}
								$tableAdoptions.= "</tr>";
							}
							$tableAdoptions.= "</tbody>";
						$tableAdoptions.= "</table>";
			break;
			case "001":
				$tableAdoptions = "<table>
										<thead>
											<tr>
												<th>NOMBRE</th>
												<th>TIPO</th>
												<th>RAZA</th>						
											</tr>
										</thead>
										<tbody>
											<tr><td colspan='3'>Sin datos.</td></tr></tbody>
									</table>";
			break;
			case "002":
				$tableAdoptions = "<div>query: " . $arDataAdoptions[ "status" ][ "strSQL" ] . "</div>";
				$tableAdoptions.= "<div>Cod.Error: " . $arDataAdoptions[ "status" ][ "codErrorSQL" ] . "</div>";
				$tableAdoptions.= "<div>Des.Error:" . $arDataAdoptions[ "status" ][ "desErrorSQL" ] . "</div>";
			break;
			default:
			
		}
		
		$arTableUsers[ 0 ] = $arDataAdoptions[ "status" ][ "codError" ];
		$arTableUsers[ 1 ] = $tableAdoptions;
		
		return $arTableUsers;
	}

?>
