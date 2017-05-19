<?php

	/**
	*	Autor: Camilo Figueroa ( Crivera )
	*	Primer archivo del sitio para la instalación de un aplicativo, aunque el aplicativo en sí no existe, solo se ... 
	*	mostrará el proceso de instalación que finalmente llevará a una pantalla de inicio del aplicativo.
	*/
	//echo file_exists( "instalador.php" );

	if( file_exists( "instalador.php" ) == true )
	{
		//echo "El archivo de configuración existe, se procederá a ir al sitio.";
			header( "location: form_login.php" );
	
	}else{
			//echo "El archivo no existe, se proceder&aacute; a ir al instalador.";
			header( "location: form_login.php" );
		}
?>
