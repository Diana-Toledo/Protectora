<?php
	function mod001_conectoBD () {
		$direccion = "localhost";
		$usuario = "root";
		$contrasena = "";
		$database = "protectora";
		
		$db = mysqli_connect ( $direccion, $usuario, $contrasena, $database );
		if ( !$db ) {
			echo "conexion fallida";
		} 
		
		return $db;
		
	}
	
	function mod001_desconectoBD ( $link ) {
		// Realizar la query de desconexión.
		if ( $link ) {
			mysqli_close( $link );
		}
	}
?>
