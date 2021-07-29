<?php
	/**
	-- Descripción larga --
		Recupero si la variable idanimal existe de la URL sino existe me envía al main.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de la view/vista_veranimal.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getAnimalsById( $idAnimal )
		mod004_getSelectRaces()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	require ( "lib/mod004_presentacion.php" );
	require("cabecera.php");
	if ( isset( $_GET[ "idanimal" ] ) ) { 
		$idAnimal = $_GET[ "idanimal" ];
	} else {
		header( 'Location: main' );
	}	
	$idAnimal = $_GET[ "idanimal" ];
	$arTableAnimals = mod004_getAnimalsById( $idAnimal );
	$layerSelect = mod004_getSelectRaces();
	if ( $arTableAnimals[ 0 ] !== "002" ) {
		require ( "view/vista_veranimal.php" );
	} else {
		$dataError = $arTableAnimals[ 1 ];
		
		require ( "view/vista_gesterror.php" );
	}
	require("footer.php");
	
?>