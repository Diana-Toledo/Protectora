<?php
	/**
	-- Descripción larga --
		Recupero si la variable idraza existe en la URL sino existe me envía a la paginación 1.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de view/vista_verraza.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getAnimalsByNameRace( $idRaza)
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	require ( "lib/mod004_presentacion.php" );
	require("cabecera.php");
	if ( isset( $_GET[ "idraza" ] ) ) { 
		$idRaza = $_GET[ "idraza" ];
	} else {
		header( 'Location: main' );
	}
	echo "idRaza= " . $idRaza . "<br/>" ;
	$idRaza = $_GET[ "idraza" ];
	echo "$idRaza ="  . $idRaza . "<br>";	
	$arTableRaces = mod004_getAnimalsByNameRace( $idRaza);
	if ( $arTableRaces[ 0 ] !== "002" ) {
		require ( "view/vista_verraza.php" );
	} else {
		$dataError = $arTableRaces[ 1 ];
		require ( "view/vista_gesterror.php" );
	}
	require("footer.php");
	
?>
 
