<?php

    include_once( "nucleo.php" );
    
    //$nombre_region, $categoria, $url
    if (isset($_GET)) {
	    $respuesta = guardar_foto( $_GET[ 'nombre_region' ], $_GET[ 'categoria' ], $_GET[ 'url' ] );
	   if ($respuesta == 1) { 
	    	echo  "<script>window.location.href='foto/index.php?error=1'</script>";
	   }else{
	   		echo  "<script>window.location.href='foto/index.php?error=0'</script>";
	   }
    }
    if ($_POST) {
	    echo "error=".guardar_foto( $_POST[ 'nombre_region' ], $_POST[ 'categoria' ], $_POST[ 'url' ] );
    }
?>
