<?php
	/**
	-- Descripción larga --
		Recupero si la variable pag existe de la URL sino existe me envía a la paginación 1.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de view/vista_razas.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getRacePagination( $pag, $numRegistros )
		mod004_getSelectType()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	require ( "lib/mod004_presentacion.php" );	
	require ("cabecera.php");

	if ( isset( $_GET[ "pag" ] ) ) {
		$pag = $_GET[ "pag" ];
	} else {
		$pag = 1;
	}
		
	$numRegistros = 5;
	/* llamadas a las funciones de 	presentación-modelo para recuperar los datos que serán mostrados en la página. */
	$arTableRaces = mod004_getRacePagination( $pag, $numRegistros );
	$layerSelect = mod004_getSelectType();
	if ( $arTableRaces[ 0 ] !== "002" ) {
    	require ( "view/vista_razas.php" );
	} else {
		$dataError = $arTableRaces[ 1 ];
		require ( "view/vista_gesterror.php" );
	}
	
	require ("footer.php");	
?>