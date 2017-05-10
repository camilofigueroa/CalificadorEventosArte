<?php

    include_once( "nucleo.php" );
    
    //$nombre_region, $categoria, $url
    //echo "error=".guardar_foto( $_GET[ 'nombre_region' ], $_GET[ 'categoria' ], $_GET[ 'url' ] );
    echo "error=".guardar_foto( $_POST[ 'nombre_region' ], $_POST[ 'categoria' ], $_POST[ 'url' ] );

?>