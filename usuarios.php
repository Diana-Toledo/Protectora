<?php
	/**
	-- Descripción larga --
		Recupero si la variable pag existe de la URL sino existe me envía a la paginación 1.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de view/vista_usuarios.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getUserPagination( $pag, $numRegistros )
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
		
	$numRegistros = 4;	

	$arTableUsers = mod004_getUserPagination( $pag, $numRegistros );
	
	if ( $arTableUsers[ 0 ] !== "002" ) {
		require ( "view/vista_usuarios.php" );
	} else {
		$dataError = $arTableUsers[ 1 ];
		require ( "view/vista_gesterror.php" );
	}   
	
	require ("footer.php");
?>
