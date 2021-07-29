
 <?php
	require ( "mod001_conexion.php" );

/**
	mod002_getUserPagination( $regInicio, $numRegistros )

		-- Descripción larga --
			Esta función me devuelve en cada página el número de registros de usuarios que específico.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getUserPagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
					//PAGINACIÓN

	function mod002_getUserPagination( $regInicio, $numRegistros ) {
		$link = mod001_conectoBD();

		$strSQL = "SELECT 300_idusuario, 300_nomusuario, 300_apellidos, 300_dni, 300_email, 300_contrasena, 300_fecnacimiento, 300_telefono, 300_fecalta, 300_imgusuario";
		$strSQL.= " FROM 300_usuarios"; 
		$strSQL.= " WHERE 300_idusuario = 300_idusuario";
		$strSQL.= " ORDER BY 300_nomusuario";
		$strSQL.= " LIMIT $regInicio, $numRegistros";
	
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );		
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {
					$arRetorno[ "data" ][ $i ][ "idusuario" ] 	  = $row[ "300_idusuario" ];
					$arRetorno[ "data" ][ $i ][ "nomusuario" ] 	  = $row[ "300_nomusuario" ];
					$arRetorno[ "data" ][ $i ][ "apellidos" ] 	  = $row[ "300_apellidos" ];
					$arRetorno[ "data" ][ $i ][ "fecnacimiento" ] = $row[ "300_fecnacimiento" ];
					$arRetorno[ "data" ][ $i ][ "fecalta" ] 	  = $row[ "300_fecalta" ];
					$i++;				
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	} 
	/**
	mod002_getUserTotal()

		-- Descripción larga --
			Esta función me devuelve el número de registros en la tabla 300_usuarios.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getUserTotal()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/	
	function mod002_getUserTotal() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT( * ) AS totalusuarios
					FROM 300_usuarios";
					
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );			
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
				
				while ( $row = mysqli_fetch_array( $result ) ) {				
					$arRetorno[ "data" ][ $i ][ "totalusuarios" ] 	= $row[ "totalusuarios" ];					
					$i++;
				}
			} else {
				// La query es correcta SIN datos.
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			// Error query erronea o problemas con el servidor.
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/**
	mod002_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario )

		-- Descripción larga --
			Esta función inserta un registro en la tabla 300_usuarios.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" que trata los errores.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_insertHighUser()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_insertHighUser( $nomusuario, $apeusuario, $dnisuario, $emailusuario, $passusuario, $fecusuario, $telusuario, $altausuario, $imgusuario ) {
		$link = mod001_conectoBD();
		
		$strSQL = "INSERT INTO `300_usuarios`
					( 300_idusuario, 300_nomusuario, 300_apellidos, 300_dni, 300_email, 300_contrasena, 300_fecnacimiento, 300_telefono, 300_fecalta, 300_imgusuario )
				   VALUES 
					( null, '$nomusuario', '$apeusuario', '$dnisuario', '$emailusuario', '$passusuario', '$fecusuario', '$telusuario', '$altausuario', '$imgusuario' )";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );			 
			if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
				$arRetorno[ "data" ][ 0 ][ "idUserNew" ] = mysqli_insert_id( $link );
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;	
	}


	/** 
	mod002_getUserById( $idUsuario )

		-- Descripción larga --
			Esta función me devuelve los datos de un usuario en concreto el cual se identifica mediante idusuario
		-- Argumentos --
			$idUsuario              : Es un número que identifica el usuario de forma univoca.
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getUserById( $idUsuario )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	*/

	function mod002_getUserById( $idUsuario ) { 
		$link = mod001_conectoBD();

		$strSQL = "SELECT *";
		$strSQL.= " FROM 300_usuarios";
		$strSQL.= " WHERE 300_idusuario = 300_idusuario";
		$strSQL.= " AND 300_idusuario = $idUsuario";

		$result = mysqli_query( $link, $strSQL );		
		$i = 0;
		if ( $result ) { 
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
					
				while ( $row = mysqli_fetch_array( $result ) ) { 
					$arRetorno[ "data" ][ $i ][ "idusuario" ] 	  = $row[ "300_idusuario" ];
					$arRetorno[ "data" ][ $i ][ "nomusuario" ] 	  = $row[ "300_nomusuario" ];
					$arRetorno[ "data" ][ $i ][ "apellidos" ]     = $row[ "300_apellidos" ];
					$arRetorno[ "data" ][ $i ][ "email" ] 	      = $row[ "300_email" ];	
					$arRetorno[ "data" ][ $i ][ "dni" ] 	      = $row[ "300_dni" ];
					$arRetorno[ "data" ][ $i ][ "contrasena" ]    = $row[ "300_contrasena" ];
					$arRetorno[ "data" ][ $i ][ "fecnacimiento" ] = $row[ "300_fecnacimiento" ];
					$arRetorno[ "data" ][ $i ][ "telefono" ] 	  = $row[ "300_telefono" ];
					$arRetorno[ "data" ][ $i ][ "fecalta" ]       = $row[ "300_fecalta" ];
					$arRetorno[ "data" ][ $i ][ "imgusuario" ] 	  = $row[ "300_imgusuario" ];								
					$i++;
				}
			} else {
			// La query es correcta sin datos.
			$arRetorno[ "status" ][ "codError" ] = "001";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			// Error query erronea o problemas con el servidor.
			$arRetorno[ "status" ][ "codError" ]    = "002";
			$arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link );
		}		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/**
	mod002_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario )

		-- Descripción larga --
			Esta función actualiza los datos de un usuario.
		-- Argumentos --
			$idUsuario              : Es un número que identifica el usuario de forma univoca.

		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" que trata los errores.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_updateUser()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_updateUser( $idusuario, $nomusuario, $apellidos, $dni, $imgusuario ) {
		$link = mod001_conectoBD();
		
		$strSQL = "UPDATE 300_usuarios SET
							300_nomusuario    = '$nomusuario',
							300_apellidos     = '$apellidos',
							300_dni           = '$dni',							
							300_imgusuario    = '$imgusuario'
							WHERE 300_idusuario = $idusuario";

		$result = mysqli_query( $link, $strSQL );
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );		 
			if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;	
	}

	                      // ANIMALES
		/**
	mod002_getAnimalPagination( $regInicio, $numRegistros )

		-- Descripción larga --
			Esta función me devuelve en cada página el número registros de animales que específico.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getAnimalPagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/

	function mod002_getAnimalPagination( $regInicio, $numRegistros ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT 211_idanimal, 211_nomanimal, 211_imganimal";
		$strSQL.= " FROM 211_animales"; 
		$strSQL.= " ORDER BY 211_nomanimal";
		$strSQL.= " LIMIT $regInicio, $numRegistros"; 
			
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );		
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {
					// Recupero los datos.
					$arRetorno[ "data" ][ $i ][ "idanimal" ] 	   = $row["211_idanimal"];
					$arRetorno[ "data" ][ $i ][ "nomanimal" ] 	   = $row["211_nomanimal"];
					$arRetorno[ "data" ][ $i ][ "imganimal" ] 	   = $row["211_imganimal"];
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	} 
	/** 
	mod002_getAnimalTotal()

	-- Descripción larga --
		Esta función me devuelve el número de registros de animales en la tabla 211_animales.
	-- Argumentos --
	-- Variables principales --
		$link                   : Es la variable que indica el enlace a la base de datos.
		$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
		$result                 : Es la variable que contiene el resultado de la query.
	-- Retorno --
		$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
	-- Funciones a la que llama.
		mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
		mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
	-- funciones que la llaman.
		mod003_getAnimalTotal()
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

**/
	function mod002_getAnimalTotal() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT( * ) AS totalanimales
					FROM 211_animales";
		
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );			
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {					
					$arRetorno[ "data" ][ $i ][ "totalanimales" ] 	= $row[ "totalanimales" ];					
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	} 
	
	/** 
	mod002_getAnimalsById( $idAnimal )

	-- Descripción larga --
		Esta función me devuelve los datos de un animal en concreto el cual se identifica mediante el idanimal
	-- Argumentos --
		$idAnimal              : Es la variable que cntiene un número que identifica al animal de forma univoca.
	-- Variables principales --
		$link                   : Es la variable que indica el enlace a la base de datos.
		$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
		$result                 : Es la variable que contiene el resultado de la query.
	-- Retorno --
		$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
	-- Funciones a la que llama.
		mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
		mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
	-- funciones que la llaman.
		mod003_getAnimalsById( $idAnimal )
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	function mod002_getAnimalsById( $idAnimal ) { 
		$link = mod001_conectoBD();

		$strSQL = "SELECT 211_animales.211_idanimal, 211_nomanimal, 211_anionacimiento, 211_sexo, 211_imganimal, 211_peso, 211_altura, 210_razas.210_idraza, 210_nomraza, 212_fecencontrado, 212_lugarencontrado
						FROM 211_animales, 210_razas, 212_historiales
						WHERE 211_animales.210_idraza = 210_razas.210_idraza
						AND 211_animales.211_idanimal = 212_historiales.211_idanimal
						AND 211_animales.211_idanimal = $idAnimal";
			$result = mysqli_query( $link, $strSQL );
			$i = 0;
			if ( $result ) { 
				$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
				if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
					$arRetorno[ "status" ][ "codError" ] = "000";		
					while ( $row = mysqli_fetch_array( $result ) ) { 
						$arRetorno[ "data" ][ $i ][ "idanimal" ] 	    = $row[ "211_idanimal" ];
						$arRetorno[ "data" ][ $i ][ "nomanimal" ] 	    = $row[ "211_nomanimal" ];					
						$arRetorno[ "data" ][ $i ][ "sexo" ] 	        = (bool)$row[ "211_sexo" ];
						$arRetorno[ "data" ][ $i ][ "anionacimiento" ]  = $row[ "211_anionacimiento" ];
						$arRetorno[ "data" ][ $i ][ "imganimal" ]       = $row[ "211_imganimal" ];
						$arRetorno[ "data" ][ $i ][ "peso" ] 	        = $row[ "211_peso" ];
						$arRetorno[ "data" ][ $i ][ "altura" ] 	        = $row[ "211_altura" ];
						$arRetorno[ "data" ][ $i ][ "nomraza" ] 	    = $row[ "210_nomraza" ];
						$arRetorno[ "data" ][ $i ][ "fecencontrado" ] 	= $row[ "212_fecencontrado" ];
						$arRetorno[ "data" ][ $i ][ "lugarencontrado" ] = $row[ "212_lugarencontrado" ];
						$i++;
					}
				} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ]    = "002";
				$arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
				$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
				$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link );
			}
			
			mod001_desconectoBD( $link );
			return $arRetorno;
		}

		/** 
		mod002_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza )

		-- Descripción larga --
			Esta función inserta un registro de un animal en la tabla 211_animales.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" que trata los errores.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_insertHighAnimal()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/

	
	function mod002_insertHighAnimal( $nomanimal, $sexo, $anionacimiento, $imganimal, $peso, $altura, $desanimal, $idraza ) {
		$link = mod001_conectoBD();
		
		$strSQL = "INSERT INTO `211_animales`
					( 211_idanimal, 211_nomanimal, 211_sexo, 211_anionacimiento, 211_imganimal, 211_peso, 211_altura, 211_desanimal, 210_idraza )
				   VALUES 
					( null, '$nomanimal', '$sexo', '$anionacimiento', '$imganimal', '$peso', '$altura', '$desanimal', '$idraza' )";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );			 
			if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;	
	}
/** 
	mod002_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza)

	-- Descripción larga --
		Es una transacción entre la tabla 211_animales y la tabla 212_historiales, tiene la función de actualizar los datos del animal y el 
		historial. Primero realiza la actualización de los datos del animal y si esta va bien procede a actualizar el historial (lugar y fecha
		encontrados). En caso de que alguna de las query vaya mal vuelve al comienzo.
	-- Argumentos --
	-- Variables principales --
		$link                   : Es la variable que indica el enlace a la base de datos.
		$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
		$result                 : Es la variable que contiene el resultado de la query.
	-- Retorno --
		$arRetorno              : Esta variable develve un array con las posiciones "status" que trata los errores.
	-- Funciones a la que llama.
		mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
		mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
	-- funciones que la llaman.
		mod003_updateAnimal()
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

**/
		function mod002_updateAnimal( $idanimal, $nomanimal, $sexo, $imganimal, $fecencontrado, $lugarencontrado, $idraza) {
			$link = mod001_conectoBD();
			
			$strSQL = "START TRANSACTION";
			$result = mysqli_query( $link, $strSQL );
	
			$strSQL = "UPDATE `211_animales` SET
								211_nomanimal = '$nomanimal',
								211_sexo = $sexo,			
								210_idraza = $idraza,			
								211_imganimal = '$imganimal'											
								WHERE 211_idanimal = $idanimal";
	
			$result = mysqli_query( $link, $strSQL );
			if ( $result ) {
				$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL; 
				if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
					$arRetorno[ "status" ][ "codError" ] = "000";				
				} else {
					$arRetorno[ "status" ][ "codError" ] = "001";
					$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
				}		
				$strSQL = "UPDATE `212_historiales` SET
									212_fecencontrado = '$fecencontrado',
									212_lugarencontrado = '$lugarencontrado'
									WHERE 211_idanimal = $idanimal";
													
				$result = mysqli_query( $link, $strSQL );
				
				if ( $result ) {
					$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );
					$arRetorno[ "status" ][ "strSQL" ].= " ## " . $strSQL; 
					if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
						$arRetorno[ "status" ][ "codError" ] = "000";					
					} else {
						$arRetorno[ "status" ][ "codError" ] = "001";			
					}
					
					$strSQL = "COMMIT";
					$result = mysqli_query( $link, $strSQL );
	
				} else {
					$arRetorno[ "status" ][ "codError" ] = "002";
					$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
					$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
					$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
					
					$strSQL = "ROLLBACK";
					$result = mysqli_query( $link, $strSQL );
				}			
			} else {
				$arRetorno[ "status" ][ "codError" ] = "002";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
				$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
				$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
				
				$strSQL = "ROLLBACK";
				$result = mysqli_query( $link, $strSQL );						
			}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;	
	}

	                             // RAZAS
	/**
	mod002_getAnimalsByNameRace( $idRaza )

		-- Descripción larga --
			Esta función me devuelve los datos de el o los animales que pertenecen a una raza en concreto el cual se identifica mediante idraza
		-- Argumentos --
			$idRaza                 : Es un número que identifica la raza.
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getAnimalsByNameRace( $idRaza)
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_getAnimalsByNameRace( $idRaza ) { 
		$link = mod001_conectoBD();
	
	// Esta query me trae todos los animales que pertenecen a esa raza
		$strSQL = "SELECT 211_nomanimal, 211_imganimal";
		$strSQL.= " FROM 211_animales, 210_razas"; // Guarda la query en esta variable.
		$strSQL.= " WHERE 211_animales.210_idraza = 210_razas.210_idraza";
		$strSQL.= " AND 210_razas.210_idraza = $idRaza";
		$result = mysqli_query( $link, $strSQL );
		$i = 0;
		if ( $result ) { 
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";					
				while ( $row = mysqli_fetch_array( $result ) ) { 
					$arRetorno[ "data" ][ $i ][ "nomanimal" ] 	   = $row[ "211_nomanimal" ];
					
					$arRetorno[ "data" ][ $i ][ "imganimal" ]      = $row[ "211_imganimal" ];
								
					$i++;
				}
			} else {
			// La query es correcta sin datos.
			$arRetorno[ "status" ][ "codError" ] = "001";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			// Error query erronea o problemas con el servidor.
			$arRetorno[ "status" ][ "codError" ]    = "002";
			$arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link );
		}
		
		mod001_desconectoBD( $link );

		return $arRetorno;
	}

/** 
	mod002_getRacePagination( $regInicio, $numRegistros )

		-- Descripción larga --
			Esta función me devuelve en cada página el número de registros de razas que quiero visualizar.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getRacePagination( $pag, $numRegistros )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_getRacePagination( $regInicio, $numRegistros ) {
		$link = mod001_conectoBD();

		$strSQL = "SELECT 210_idraza, 210_nomraza, 200_tipos.200_idtipo, 200_nomtipo";
		$strSQL.= " FROM 210_razas, 200_tipos"; 
		$strSQL.= " WHERE 210_razas.200_idtipo = 200_tipos.200_idtipo";
		$strSQL.= " ORDER BY 210_nomraza";
		$strSQL.= " LIMIT $regInicio, $numRegistros"; 

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );			
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {
					// Recupero los datos.
					$arRetorno[ "data" ][ $i ][ "idraza" ] 	 = $row["210_idraza"];
					$arRetorno[ "data" ][ $i ][ "nomraza" ]  = $row["210_nomraza"];
					$arRetorno[ "data" ][ $i ][ "nomtipo" ]  = $row["200_nomtipo"];
					$i++;
				}
			} else {
				// La query es correcta SIN datos.
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	} 
	/** 
	mod002_getRaceTotal() 

	-- Descripción larga --
		Esta función me devuelve el número de registros de razas en la tabla 210_razas.
	-- Argumentos --
	-- Variables principales --
		$link                   : Es la variable que indica el enlace a la base de datos.
		$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
		$result                 : Es la variable que contiene el resultado de la query.
	-- Retorno --
		$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
	-- Funciones a la que llama.
		mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
		mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
	-- funciones que la llaman.
		mod003_getRaceTotal() 
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

**/
	function mod002_getRaceTotal() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT( * ) AS totalrazas
					FROM 210_razas";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );			
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {					
					$arRetorno[ "data" ][ $i ][ "totalrazas" ] 	= $row[ "totalrazas" ];					
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	} 
	
	/**
	mod002_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo )

		-- Descripción larga --
			Esta función inserta un registro de raza en la tabla de 210_razas.
		-- Argumentos --	
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_insertHighRace()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/	
	
	function mod002_insertHighRace( $nomraza, $imgraza, $desraza, $idtipo ) {
		$link = mod001_conectoBD();
		
		$strSQL = "INSERT INTO `210_razas`
					( 210_idraza, 210_nomraza, 210_imgraza, 210_descraza, 200_idtipo )
				   VALUES 
					( null, '$nomraza', '$imgraza', '$desraza', '$idtipo' )";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRowsAffected" ] = mysqli_affected_rows( $link );			 
			if ( $arRetorno[ "status" ][ "numRowsAffected" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
				$arRetorno[ "data" ][ 0 ][ "idRaceNew" ] = mysqli_insert_id( $link );
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;	
	}
	
	/**
	mod002_getSelectType()

		-- Descripción larga --
			Esta función me devuelve los nombres de los diferentes tipos de animales que hay en la tabla 200_tipos.
		-- Argumentos --		

		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getSelectType()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/	

	function mod002_getSelectType() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *
					FROM 200_tipos";

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {					
					$arRetorno[ "data" ][ $i ][ "idtipo" ] 	= $row[ "200_idtipo" ];
					$arRetorno[ "data" ][ $i ][ "nomtipo" ] 	= $row[ "200_nomtipo" ];
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

						//RAZAS
/** 
	mod002_getSelectRaces()

		-- Descripción larga --
			Esta función me devuelve los nombres de las diferentes razas de animales que hay en la tabla 210_razas.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getSelectRaces()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/	
	function mod002_getSelectRaces() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *
					FROM 210_razas";

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {					
					$arRetorno[ "data" ][ $i ][ "idraza" ] 	= $row[ "210_idraza" ];
					$arRetorno[ "data" ][ $i ][ "nomraza" ] 	= $row[ "210_nomraza" ];
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}


/** 
	mod002_getHistorialAnimal( $idAnimal )

		-- Descripción larga --
			Esta función me devuelve el lugar y la fecha encontrado de cada animal.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getHistorialAnimal( $idAnimal )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_getHistorialAnimal( $idAnimal ) {		
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT 212_fecencontrado, 212_lugarencontrado
					FROM 212_historiales
					WHERE 211_idanimal = $idAnimal";
					
		$result = mysqli_query( $link, $strSQL );	
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";			
				while ( $row = mysqli_fetch_array( $result ) ) {
					$arRetorno[ "data" ][ $i ][ "idanimal" ] 	= $idAnimal;
					$arRetorno[ "data" ][ $i ][ "fecencontrado" ] = $row[ "212_fecencontrado" ];
					$arRetorno[ "data" ][ $i ][ "lugarencontrado" ] = $row[ "212_lugarencontrado" ];
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {

			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link ); 
		
		return $arRetorno;
	}

							// ADOPCIONES
	/** 
	mod002_getAdoptions()

		-- Descripción larga --
			Esta función me devuelve el nombre, el tipo y la raza de los animales que no han sido adoptados.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getAdoptions()
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_getAdoptions() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT 211_animales.211_idanimal, 211_nomanimal, 200_nomtipo, 210_nomraza	
					FROM 200_TIPOS
					Left JOIN 210_RAZAS
					ON 200_TIPOS.200_idtipo = 210_RAZAS.200_idtipo
					INNER JOIN 211_ANIMALES
					ON 210_RAZAS.210_idraza = 211_ANIMALES.210_idraza
					LEFT JOIN 311_ADOPCIONES
					ON 211_ANIMALES.211_idanimal = 311_ADOPCIONES.211_idanimal
					WHERE 311_ADOPCIONES.211_idanimal IS NULL
					ORDER BY 211_nomanimal ASC";

		$result = mysqli_query( $link, $strSQL );
		$i = 0;
		if ( $result ) { 
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ "data" ][ $i ][ "idanimal" ]  = $row[ "211_idanimal" ];
				$arRetorno[ "data" ][ $i ][ "nomanimal" ]  = $row[ "211_nomanimal" ];
				$arRetorno[ "data" ][ $i ][ "nomtipo" ]  = $row[ "200_nomtipo" ];
				$arRetorno[ "data" ][ $i ][ "nomraza" ] = $row[ "210_nomraza" ];			
				$i++;
			}
			} else {
				// La query es correcta SIN datos.
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			// Error query erronea o problemas con el servidor.
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/** 
	mod002_getPhotoAnimal( $idAnimal )

		-- Descripción larga --
			Esta función me devuelve la imagen y los datos de cada animal adoptado.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getPhotoAnimal( $idAnimal )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/
	function mod002_getPhotoAnimal( $idAnimal ) {
		$link = mod001_conectoBD();

		$strSQL = "SELECT 211_idanimal, 211_nomanimal, 211_anionacimiento, 211_sexo, 211_imganimal, 211_peso, 211_altura, 211_desanimal, 210_razas.210_idraza, 210_nomraza
					FROM 211_animales, 210_razas
					WHERE 211_animales.210_idraza = 210_razas.210_idraza 
					AND 211_idanimal = $idAnimal";

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";				
				while ( $row = mysqli_fetch_array( $result ) ) {
					$arRetorno[ "data" ][ $i ][ "idanimal" ] 	= $idAnimal;
					$arRetorno[ "data" ][ $i ][ "photoanimal" ] = $row[ "211_imganimal" ];
					$arRetorno[ "data" ][ $i ][ "nomanimal" ] = $row[ "211_nomanimal" ];
					$arRetorno[ "data" ][ $i ][ "sexo" ] 	       = (bool)$row[ "211_sexo" ];
					$arRetorno[ "data" ][ $i ][ "anionacimiento" ] = $row[ "211_anionacimiento" ];
					$arRetorno[ "data" ][ $i ][ "peso" ] 	       = $row[ "211_peso" ];
					$arRetorno[ "data" ][ $i ][ "altura" ] 	       = $row[ "211_altura" ];
					$arRetorno[ "data" ][ $i ][ "desanimal" ]      = $row[ "211_desanimal" ];
					$arRetorno[ "data" ][ $i ][ "idraza" ] 	       = $row[ "210_idraza" ];
					$arRetorno[ "data" ][ $i ][ "nomraza" ] 	   = $row[ "210_nomraza" ];	
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
			$arRetorno[ "status" ][ "codError" ] = "002";
			$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
			$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link ); 

		return $arRetorno;
	}

		/** 
	mod002_getAdoption( $busNombre )

		-- Descripción larga --
			Esta función me devuelve el nombre, tipo y raza de los animales que contengan en su nombre la letra que específico.
		-- Argumentos --
		-- Variables principales --
			$link                   : Es la variable que indica el enlace a la base de datos.
			$strSQL                 : Es la variable que guarda la query que vamos a ejecutar.
			$result                 : Es la variable que contiene el resultado de la query.
		-- Retorno --
			$arRetorno              : Esta variable develve un array con las posiciones "status" y  "data" que trata los errores y la información.
		-- Funciones a la que llama.
			mod001_conectoBD()      : Esta función nos conecta a la base de datos, mediante la cual accedemos a la información.
			mod001_desconectoBD( $link ) : Esta función nos desconecta de la base de datos en cuanto hemos obtenido la información.
		-- funciones que la llaman.
			mod003_getAdoption( $busNombre )
		-- Autor: Diana Toledo Girón.
		-- Fechas.
			Creación    : 2021 - Junio
			Review      : 2021 - Junio

	**/

	function mod002_getAdoption( $busNombre ) {
		$link = mod001_conectoBD();
		$busNombre = "%".$busNombre."%";
	
		$strSQL = "SELECT 211_animales.211_idanimal, 211_nomanimal, 200_nomtipo, 210_nomraza	
					FROM 200_TIPOS
					Left JOIN 210_RAZAS
					ON 200_TIPOS.200_idtipo = 210_RAZAS.200_idtipo
					INNER JOIN 211_ANIMALES
					ON 210_RAZAS.210_idraza = 211_ANIMALES.210_idraza
					LEFT JOIN 311_ADOPCIONES
					ON 211_ANIMALES.211_idanimal = 311_ADOPCIONES.211_idanimal
					WHERE 311_ADOPCIONES.211_idanimal IS NULL
					AND 211_ANIMALES.211_nomanimal LIKE '$busNombre'
					ORDER BY 211_nomanimal ASC";
	
		$result = mysqli_query( $link, $strSQL );
		$i = 0;
		if ( $result ) { 
			$arRetorno[ "status" ][ "numRows" ] = mysqli_num_rows( $result );
			if ( $arRetorno[ "status" ][ "numRows" ] !== 0 ) {
				$arRetorno[ "status" ][ "codError" ] = "000";	
				while ( $row = mysqli_fetch_array( $result ) ) { 
					$arRetorno[ "data" ][ $i ][ "idanimal" ]  = $row[ "211_idanimal" ];
					$arRetorno[ "data" ][ $i ][ "nomanimal" ] = $row[ "211_nomanimal" ];
					$arRetorno[ "data" ][ $i ][ "nomtipo" ]   = $row[ "200_nomtipo" ];
					$arRetorno[ "data" ][ $i ][ "nomraza" ]   = $row[ "210_nomraza" ];			
					$i++;
				}
			} else {
				$arRetorno[ "status" ][ "codError" ] = "001";
				$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
			}
		} else {
		$arRetorno[ "status" ][ "codError" ] = "002";
		$arRetorno[ "status" ][ "strSQL" ] = $strSQL;
		$arRetorno[ "status" ][ "codErrorSQL" ] = mysqli_errno( $link );
		$arRetorno[ "status" ][ "desErrorSQL" ] = mysqli_error( $link ); 
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
?>
