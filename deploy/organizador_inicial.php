<?php

    /**
    * Autor: Camilo Figueroa ( Crivera )
    * Este archivo se crea para organizar inicialmente todo lo que tiene que ver con las combinaciones
    * entre los diferentes elementos que al detalle generan un nuevo texto que ha de contener
    * el número de calificación para esa combinación. 
    */

    include( "config.php" );

    //Borramos todo lo de la tabla de calificaciones.
    $sql  = " TRUNCATE TABLE tb_calificaciones; ";
    $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
    $resultado = $conexion->query( $sql );

    $sql .= " ALTER TABLE tb_calificaciones AUTO_INCREMENT = 1; ";
    $resultado = $conexion->query( $sql );

    $sql  = " INSERT INTO tb_calificaciones ( id, criterio, categoria, jurado, nombre_region ) ";
    $sql .= " SELECT null, t3.criterio, t5.categoria, t2.jurado, t4.nombre_region ";
    $sql .= " FROM tb_jurados t2, tb_criterios t3, tb_regiones t4, tb_categorias t5 ";
    $sql .= " WHERE INSTR( t3.indicador_categoria, t5.acronimo_categoria ) > 0 ";
    $sql .= " AND INSTR( t4.indicador_categoria, t5.acronimo_categoria ) > 0 ";
    //$sql .= " AND INSTR( t2.indicador_categoria, t5.acronimo_categoria ) > 0 ";
    $sql .= " ORDER BY t5.categoria, t2.jurado, t4.nombre_region; ";
    $resultado = $conexion->query( $sql );

    //Esto debe suceder si las tablas madre ya tienen organizados todos los registros.
    //La única que debería estar vacía a este punto es la de imágenes y calificaciones. 
    $sql = " SELECT * FROM tb_calificaciones ORDER BY jurado, categoria, nombre_region, criterio ";
    $resultado = $conexion->query( $sql );

    //Para construir una tablita organizada en html.
    $organizacion_visual = " <table border='1px'> ";
    $contador_cambiante = 0;
    $verificador_cambios = "";
    $columnas_implicadas = "";

    while( $fila = mysqli_fetch_array( $resultado ) )
    {
        $columnas_implicadas = $fila[ 2 ]." ".$fila[ 3 ];

        if( $verificador_cambios != $columnas_implicadas )
        {
            $contador_cambiante = 1;
            $verificador_cambios = $columnas_implicadas;

        }else{
                $contador_cambiante ++; //Afectamos el contador para esa fila.
            }

        $organizacion_visual .= " <tr> ";

        //Se recorren las columnas de cada fila.
        for( $i = 0; $i < mysqli_num_fields( $resultado ); $i ++ )
        {
            $organizacion_visual .= " <td> ";

            if( $i != mysqli_num_fields( $resultado ) - 1 )
            {
                $organizacion_visual .= $fila[ $i ];

            }else{
                    //Aquí se determina el número del text input que debe tener esa determinada 
                    //combinación calificable.
                    $organizacion_visual .= $contador_cambiante;
                    $sql  = " UPDATE tb_calificaciones SET text_input_name = 'texto".$contador_cambiante."' ";
                    $sql .= " WHERE id = ".$fila[ 0 ];
                    $conexion->query( $sql );
                    //echo $sql;

                }

            $organizacion_visual .= " </td> ";
        }

        $organizacion_visual .= " </tr> ";
    }
    $organizacion_visual .= " </table> ";

    echo $organizacion_visual;
