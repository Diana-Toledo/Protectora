<?php
	/**
	-- Descripción larga --
		Recupero si la variable idusuario existe en la URL sino existe me envía a main.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de view/vista_verusuario.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getUserById( $idUsuario )
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	require ( "lib/mod004_presentacion.php" );
	require ("cabecera.php");
	if ( isset( $_GET[ "idusuario" ] ) ) { 
		$idUsuario = $_GET[ "idusuario" ];
	} else {
		header( 'Location: main' );
	}	
	echo "idUsuario= " . $idUsuario . "<br/>" ;
	$idUsuario = $_GET[ "idusuario" ];
	echo "$idUsuario ="  . $idUsuario . "<br>";
	
	$arTableUsers = mod004_getUserById( $idUsuario );
	
	if ( $arTableUsers[ 0 ] !== "002" ) {
		require ( "view/vista_verusuario.php" );
	} else {
		$dataError = $arTableUsers[ 1 ];
		require ( "view/vista_gesterror.php" );
	}

	require ("footer.php");
	
?>
