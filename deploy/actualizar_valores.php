<?php

    include_once( "config.php" );
    include_once( "nucleo.php" );
    
    $i = 0;
    $valor = 0;
    
    if( isset( $_GET[ 'cat' ] ) && isset( $_GET[ 'jur' ] ) )
    {
        echo $_GET[ 'cat' ]." - ".$_GET[ 'jur' ]."<br><br>";
        
        for( $i = 0; $i <= 100; $i ++ )
        {
            if( isset( $_POST[ 'texto'.$i ] ) )
            {
                $valor = $_POST[ 'texto'.$i ];
                if( trim( $valor ) == "" ) $valor = 0; //En esta linea, si el texto pasa vacío, se convierte en cero.
                
                echo "El texto".$i." existe. =".$valor." ";
                
                if( is_numeric( $valor ) )
                {
                    actualizar_valor_control( "texto".$i, $_GET[ 'cat' ], $_GET[ 'jur' ], $valor );
                    
                }else{
                        echo "EL valor ingresado no es numérico y no se actualizará.";
                    }
                    
                echo "<br>";
            }
        }
    }
    
    echo "<br><br>";
    echo "<a href='calificaciones.php?lista_categoria=".$_GET[ 'cat' ]."&lista_jurado=".$_GET[ 'jur' ]."'>Volver</a>";

?>

<!-- <html>
    <head>
        <title> Zonal regional Guaviare - respuestas. </title>
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
        
    </body>    
</html> -->