<?php
	/**
	-- Descripción larga --
		Recupero si la variable idanimal existe de la URL.
		LLamma a las funciones de presentación( modelo ) para recuperar los datos que serán mostrados en la página.
		El controlador hace un require de la view/vista_adopciones.php y vista hace un echo.
	-- Argumentos --
	-- Variables principales --
	-- Retorno --
	-- Funciones a la que llama.
		mod004_getAdoption($busNombre)
		mod004_getAdoptions()
	-- funciones que la llaman.
	-- Autor: Diana Toledo Girón.
	-- Fechas.
		Creación    : 2021 - Junio
		Review      : 2021 - Junio

	**/
	require ( "lib/mod004_presentacion.php" );
	require ("cabecera.php");

	$busNombre = "";
		if ( isset( $_GET[ "idanimal" ] ) ) {
			$busNombre = $_GET[ "idanimal" ];
		} 	
		if ( $busNombre !="" ) {
			$arTableAnimals = mod004_getAdoption($busNombre);
		} else {
			$arTableAnimals = mod004_getAdoptions();
		}	
		if ( $arTableAnimals[ 0 ] !== "002" ) {
			require ( "view/vista_adopciones.php" );
		} else {
			$dataError = $arTableAnimals[ 1 ];
			require ( "view/vista_gesterror.php" );
		}
		
		require ("footer.php");	
?>