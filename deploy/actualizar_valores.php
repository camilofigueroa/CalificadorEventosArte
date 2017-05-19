<?php

    include_once( "config.php" );
    include_once( "nucleo.php" );
    header('Content-Type: text/html; charset=UTF-8');
    echo "<html>";
    echo "<head>";
    echo "<title>Zonal cultural Guaviare</title>";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/estilo.css\" media=\"screen\" />";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.min.css\" media=\"screen\" />";
    echo "</head>";
    
    echo "<body>";
    echo "<div class='container-fluid'>";
    include 'encabezado.php';
    
    /*
        Lo que falta.
        
        - En la pagina que aparezca la categoria y el error del campo.
        - Campos en blanco.
        - Organizar los porcentajes.
        - Separar los enlaces.
     
    */
    
    
    $i = 0;
    $valor = 0;
    $cont_regionales = 0;
    //$conteo_existentes = 0;
    $suma_puntaje = 0;
    $max_conteo_textos = 0;
    $max_conteo = 50; //EL conteo de los textos que contienen los valores en la grilla de puntuación.
    $cont_textos_por_regional = 0;
    $band_grabar_puntaje = 0;
    $max_porcentaje = 0;
    $errores_encontrados = 0;
    $cont_registros_actualizados = 0;
    
    //Se verifica en conjunto la categoría y el jurado.    
    if( isset( $_GET[ 'cat' ] ) && isset( $_GET[ 'jur' ] ) )
    {
        echo "<br><a href='calificaciones.php?lista_categoria=".$_GET[ 'cat' ]."&lista_jurado=".$_GET[ 'jur' ]."'>Volver a la calificaci&oacute;n</a><br><br>";
        
        //Se imprime en pantalla la categoría y el jurado.
        echo $_GET[ 'cat' ]." - ".$_GET[ 'jur' ]."<br><br>";
        if( isset( $_POST[ 'cont_regionales' ] ) ) $cont_regionales = $_POST[ 'cont_regionales' ];
        //echo "<br>Regionales = ".$cont_regionales."<br>";
        
        for( $i = 0; $i <= $max_conteo; $i ++ )
        {
            if( isset( $_POST[ 'texto'.$i ] ) )
            {
                $max_conteo_textos ++;       
            }
        }
        
        //echo "<br>Conteo textos ".$max_conteo_textos."<br>";
        $cont_textos_por_regional = $max_conteo_textos / ( $cont_regionales * 1 );
        //echo "<br>Textos por regional ".$cont_textos_por_regional."<br><br>";
        
        for( $i = 0; $i <= $max_conteo; $i ++ )
        {
            $band_grabar_puntaje = 0;
            
            if( isset( $_POST[ 'texto'.$i ] ) )
            {
                $valor = $_POST[ 'texto'.$i ];
                if( trim( $valor ) == "" ) $valor = 0; //En esta linea, si el texto pasa vacío, se convierte en cero.
                
                //echo "El texto".$i." = ".$valor." ";
                //$conteo_existentes ++;
                
                if( is_numeric( $valor ) )
                {
                    $band_grabar_puntaje = 1;
                    
                    //echo "<br>Modulo".$i % $cont_textos_por_regional;
                    
                    $max_porcentaje = traer_porcentajes( "texto".$i, $_GET[ 'cat' ], $_GET[ 'jur' ] );
                    //echo "<br>Max porcentaje".$max_porcentaje."  "."texto".$i." ".$_GET[ 'cat' ]." ".$_GET[ 'jur' ];
                                      
                    if( $valor * 1 > $max_porcentaje * 1 )
                    {
                        $errores_encontrados ++;
                        echo "<div class='contenedor-error'>";
                        echo "<br>El puntaje de <strong>".traer_datos_del_texto( "texto".$i, $_GET[ 'cat' ], $_GET[ 'jur' ], "nombre_region" )."</strong> en <strong>".traer_datos_del_texto( "texto".$i, $_GET[ 'cat' ], $_GET[ 'jur' ], "criterio" )."</strong> es erróneo, no se grabará.";
                        echo "<img src='imagenes/alerta.gif'>";
                        echo "</div>";
                        $band_grabar_puntaje = 0;                        
                    }
                    
                    $suma_puntaje += $valor * 1;
                    //echo "<br>suma_puntaje ".$suma_puntaje;
                    
                    
                    if( $i % $cont_textos_por_regional == 0 )
                    {
                        //if( $suma_puntaje > 100 ) echo "<br>-------------Puntaje erroneo, es mayor a cien. Corregir.--------";
                        //echo "<br><br>Nueva regional           ----";
                        $suma_puntaje = 0;   
                    }
                    
                    if( $band_grabar_puntaje == 1 )
                    $cont_registros_actualizados += actualizar_valor_control( "texto".$i, $_GET[ 'cat' ], $_GET[ 'jur' ], $valor ) * 1;
                    
                }else{
                        echo "EL valor ingresado no es numérico y no se actualizará.";
                    }
                    
                //echo "<br>";
            }
        } //Fin del ciclo for.
        
        //Si no hay errores, se visualizarán los aspectos positivos de la grabación.
        if( $errores_encontrados <= 0 && $cont_registros_actualizados >= 0 )
        {
            //Si no hay cambios, se mostrará el letrero amarillo indicando cero errores pero sin datos a actualizar.
            if( $cont_registros_actualizados == 0 )
            {
                echo "<div class='contenedor-mensaje-correcto'>No se encontraron datos para actualizar.</div>";    
                
            }else{
                    //Si hubo cambios, se mostrarán los cambios realizados.
                    echo "<div class='contenedor-mensaje-correcto'>Se guardaron ".$cont_registros_actualizados." datos.</div>";                
                }
        }
        
        //echo "<br><br>";
        //echo "<a href='calificaciones.php?lista_categoria=".$_GET[ 'cat' ]."&lista_jurado=".$_GET[ 'jur' ]."'>Volver a la calificación</a>";
    }
    echo "</div>";
    echo "</body>";
    echo "</html>";
    
?>

<!-- <html>
    <head>
        <title> Zonal regional Guaviare - respuestas. </title>
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
        
    </body>    
</html> -->