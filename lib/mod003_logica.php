 <?php
	require ( "mod002_accesoadatos.php" );

                            // USUARIOS
	/** 
	mod003_getUserPagination( $pag, $numRegistros )
		-- Descripción larga --
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getUserPagination( $regInicio, $numRegistros )
		-- funciones que la llaman.
			  mod004_getUserPagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_getUserPagination( $pag, $numRegistros ) {
		$regInicio = ( $pag - 1 ) * $numRegistros;
		$arDataUserPagination = mod002_getUserPagination(  $regInicio, $numRegistros );

		return $arDataUserPagination;
	}
	/** 
	mod003_getUserTotal( $numRegistros )
		-- Descripción larga --
		Esta función redondea los decimales de los registros hacia arriba.
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getUserPagination( $regInicio, $numRegistros )
		-- funciones que la llaman.
			  mod004_getUserPagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_getUserTotal( $numRegistros ) {
		$arDataUserTotal = mod002_getUserTotal();
		
		if ( $arDataUserTotal[ "status" ][ "codError" ] === "000" ) {
			$totalPaginas = ceil( $arDataUserTotal[ "data" ][ 0 ][ "totalusuarios" ] / $numRegistros ); 
			
		} else  { 
		}
				
		return $totalPaginas;
	}

	/** 
	mod003_getUserById( $idUsuario )
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getUserById( $idUsuario )
		-- funciones que la llaman.
			mod004_getUserById( $idUsuario )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function  mod003_getUserById( $idUsuario ) {
		$arDataUsers = mod002_getUserById( $idUsuario );

		return $arDataUsers;
	}
	/** 
	mod003_insertHighUser()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_insertHighUser()
		-- funciones que la llaman.
			mod004_insertHighUser()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/

	function mod003_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario ) {
		$arInsertHighUser = mod002_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario );
		
		return $arInsertHighUser;
	}
	/** 
	mod003_updateUser()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_updateUser()
		-- funciones que la llaman.
			mod004_updateUser()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_updateUser( $idusuario, $nomusuario, $apellidos, $dni,  $imgusuario ) {
		$arDataUser = mod002_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario );
		return $arDataUser;
	}


					// ANIMALES

	/** 
	mod003_getAnimalsById( $idAnimal )
		-- Descripción larga --	
			Esta función me devuelve el formato que quiero que se muestren los campos de un animal peso( kilos ), altura( cm ), sexo( Hembra/Macho ), fecencontrado( d/m/Y )
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getAnimalsById( $idAnimal )
		-- funciones que la llaman.
			mod004_getAnimalsById( $idAnimal )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_getAnimalsById( $idAnimal ) {		
		$arDataAnimals = mod002_getAnimalsById( $idAnimal );
		//print_r( $arDataAnimals );
	if ( $arDataAnimals[ "status" ][ "codError" ] === "000" ) {
		for ( $i = 0; $i < count( $arDataAnimals[ "data" ] ); $i++ ) {
			$arDataAnimals[ "data" ][ $i ][ "peso" ] = number_format( $arDataAnimals[ "data" ][ $i ][ "peso" ], 2, ",", "." );		
			$arDataAnimals[ "data" ][ $i ][ "peso" ].= " kilos.";
			$arDataAnimals[ "data" ][ $i ][ "altura" ].= " cm.";
			if ($arDataAnimals[ "data" ][ $i ][ "sexo" ] ) {
				$arDataAnimals[ "data" ][ $i ][ "sexo" ] = "Hembra";
			} else {
				$arDataAnimals[ "data" ][ $i ][ "sexo" ] = "Macho";
			} if ($arDataAnimals[ "data" ][ $i ][ "fecencontrado" ] ){
				$arDataAnimals[ "data" ][ $i ][ "fecencontrado" ] = date("d/m/Y", strtotime($arDataAnimals[ "data" ][ $i ] [ "fecencontrado" ]));
			}
		}  
	} else {
		// Si hay un error lo tratamos en el mod004, no hago el tratamiento aquí.
	}
	
	return $arDataAnimals;
	}
	/** 
	 mod003_getAnimalPagination()
		-- Descripción larga --	
			Esta función redondea los decimales de los registros hacia arriba.
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_ mod003_getAnimalPagination()
		-- funciones que la llaman.
			mod004_ mod003_getAnimalPagination()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_getAnimalPagination( $pag, $numRegistros ) {
		$regInicio = ( $pag - 1 ) * $numRegistros;
		$arDataAnimalPagination = mod002_getAnimalPagination( $regInicio, $numRegistros );
		return $arDataAnimalPagination;
	}
	/** 
	mod003_mod003_getAnimalTotal()
		-- Descripción larga --	
			Esta función redondea los decimales de los registros hacia arriba.
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_updateUser()
		-- funciones que la llaman.
			mod004_mod003_getAnimalTotal()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_getAnimalTotal( $numRegistros ) {
		$arDataAnimalTotal = mod002_getAnimalTotal();
		
		if ( $arDataAnimalTotal[ "status" ][ "codError" ] === "000" ) {
			$totalPaginas = ceil( $arDataAnimalTotal[ "data" ][ 0 ][ "totalanimales" ] / $numRegistros ); //20 / 3 = 6.66 7
			
		} else  { // CodError = 001 o 002.
			//$totalPaginas = 0; //Pendiente;
		}	
		
		return $totalPaginas;
	}
	/** 
	mod003_insertHighAnimal()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_insertHighAnimal()
		-- funciones que la llaman.
			mod004_insertHighAnimal()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod003_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza ) {
		$arInsertHighAnimal = mod002_insertHighAnimal($nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza);
		
		return $arInsertHighAnimal;
	}
	/** 
	mod003_updateAnimal()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_updateAnimal()
		-- funciones que la llaman.
			mod004_updateAnimal()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza ) {
		$arDataAnimal = mod002_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal,  $fecencontrado, $lugarencontrado,  $idraza );
		
		return $arDataAnimal;
	}
	/** 
	mod003_getAnimalsByNameRace( $idRaza)
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getAnimalsByNameRace( $idRaza)
		-- funciones que la llaman.
			mod004_getAnimalsByNameRace( $idRaza)
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getAnimalsByNameRace( $idRaza) {		
		$arDataRaces = mod002_getAnimalsByNameRace( $idRaza );
		return $arDataRaces;
	}
	/** 
	 mod003_getPhotoAnimal( $idAnimal )
		-- Descripción larga --	
			Esta función me devuelve el formato que quiero que se muestren los campos de un animal peso( kilos ), altura( cm ), sexo( Hembra/Macho ), anionacimiento( años ).
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			 mod002_getPhotoAnimal( $idAnimal )
		-- funciones que la llaman.
			 mod004_getPhotoAnimal( $idAnimal )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getPhotoAnimal( $idAnimal ) {
		$arDataAnimals = mod002_getPhotoAnimal( $idAnimal );

		if ( $arDataAnimals[ "status" ][ "codError" ] === "000" ) {
			for ( $i = 0; $i < count( $arDataAnimals[ "data" ] ); $i++ ) {
				$arDataAnimals[ "data" ][ $i ][ "peso" ] = number_format( $arDataAnimals[ "data" ][ $i ][ "peso" ], 2, ",", "." );		
				$arDataAnimals[ "data" ][ $i ][ "peso" ].= " kilos.";
				$arDataAnimals[ "data" ][ $i ][ "altura" ].= " cm.";
				if ($arDataAnimals[ "data" ][ $i ][ "sexo" ] ) {
					$arDataAnimals[ "data" ][ $i ][ "sexo" ] = "Hembra";
				} else {
					$arDataAnimals[ "data" ][ $i ][ "sexo" ] = "Macho";
				} if ($arDataAnimals[ "data" ][ $i ][ "anionacimiento" ] ){
					$arDataAnimals[ "data" ][ $i ][ "anionacimiento" ] = date("Y") - $arDataAnimals[ "data" ][ $i ] [ "anionacimiento" ] . " años";
				} 
			}  
		} else {
		}
		
		return $arDataAnimals;
	}

	/** 
	mod003_getRacePagination( $pag, $numRegistros )
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getRacePagination( $regInicio, $numRegistros )
		-- funciones que la llaman.
			mod004_getRacePagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getRacePagination( $pag, $numRegistros ) { // Quiero que en esta función añada la línea.
		$regInicio = ( $pag - 1 ) * $numRegistros;
		$arDataRacePagination = mod002_getRacePagination( $regInicio, $numRegistros );

		return $arDataRacePagination;
	}
	/** 
	mod003_getRaceTotal( $numRegistros )
		-- Descripción larga --	
			Esta función redondea los decimales de los registros hacia arriba.
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getRaceTotal( $numRegistros )
		-- funciones que la llaman.
			mod004_getRaceTotal( $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/

	function mod003_getRaceTotal( $numRegistros ) {
		$arDataRaceTotal = mod002_getRaceTotal();
		
		if ($arDataRaceTotal[ "status" ][ "codError" ] === "000" ) {
			$totalPaginas = ceil( $arDataRaceTotal[ "data" ][ 0 ][ "totalrazas" ] / $numRegistros ); //20 / 3 = 6.66 7
			
		} 		
		
		return $totalPaginas;
	}
	/** 
	mod003_insertHighRace()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_insertHighRace()
		-- funciones que la llaman.
			mod004_insertHighRace()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/	
	function mod003_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo ) {
		$arInsertHighRace = mod002_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo );
		
		return $arInsertHighRace;
	}

	/** 
	mod003_getSelectType()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getSelectType()
		-- funciones que la llaman.
			mod004_getSelectType()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/	
	
	function mod003_getSelectType() {
		$arDataTypes = mod002_getSelectType();
		
		return $arDataTypes;
	}
	/** 
	mod003_getSelectRaces()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getSelectRaces()
		-- funciones que la llaman.
			mod004_getSelectRaces()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/	
	function mod003_getSelectRaces() {
		$arDataTypes = mod002_getSelectRaces();
		
		return $arDataTypes;
	}
	/** 
	mod003_mod003_getHistorialAnimal( $idAnimal )
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getHistorialAnimal( $idAnimal )
		-- funciones que la llaman.
			mod004_getHistorialAnimal( $idAnimal )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getHistorialAnimal( $idAnimal ) {
		$arDataHistorial = mod002_getHistorialAnimal( $idAnimal );

		return $arDataHistorial;
	}
	/** 
	mod003_getAdoptions()
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getAdoptions()
		-- funciones que la llaman.
			mod004_getAdoptions()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getAdoptions() {
		$arDataAdoption = mod002_getAdoptions();
		
		return $arDataAdoption;
	}

		/** 
	 mod003_getAdoption( $busNombre )
		-- Descripción larga --	
		-- Argumentos --
		-- Variables principales --
		-- Retorno --
			$arRetorno              : 
		-- Funciones a la que llama.
			mod002_getAdoption( $busNombre )
		-- funciones que la llaman.
			mod004_getAdoption( $busNombre )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio
	**/
	function mod003_getAdoption( $busNombre ) {
		$arDataSearch = mod002_getAdoption( $busNombre );
		return $arDataSearch;
	}

?>
