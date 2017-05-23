<?php

    //Se incluyen los parámetros a traves de config.php y las funciones a través de nucleo.php
    include_once( "config.php" );
    include_once( "nucleo.php" );
    
?>

<html>
    <head>
        <title> Zonal regional Guaviare - totales. </title>
    
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
        
        <?php
            imprimir_menu();
            imprimir_titulo( "Zonal cultural Guaviare" );
                    
            //Esta consulta se hace para poder separar todos los datos por categoría y en diferentes tablas.
            //$sql  = " SELECT DISTINCT categoria FROM tb_calificaciones ORDER BY categoria ";
              
            //Este query mezcla las categorías con las regiones y da prioridad a las regiones cuyo nombre representan
            //a artistas que se van a presentar en más de dos categorías.
            $sql  = " SELECT DISTINCT ";
            $sql .= " CASE ";
            $sql .= "  WHEN ( SELECT COUNT( * ) FROM tb_regiones t3 WHERE t3.agrupador_suma = t1.agrupador_suma ) > 1 THEN t1.agrupador_suma ";
            $sql .= "  ELSE t2.categoria ";
            $sql .= " END as agrupador_suma, ";
            $sql .= " ( SELECT COUNT( * ) FROM tb_regiones t4 WHERE t4.agrupador_suma = t1.agrupador_suma ) AS conteo_participaciones ";
            $sql .= " FROM tb_regiones t1, tb_calificaciones t2 ";
            $sql .= " WHERE t1.nombre_region = t2.nombre_region ";
            $sql .= " ORDER BY conteo_participaciones, t1.agrupador_suma ";
                                  
            $conexion2 = mysqli_connect( $servidor, $usuario, $clave, $bd );
            $resultado2 = $conexion2->query( $sql );
            
            //echo $sql;
                       
            if( mysqli_num_rows( $resultado2 ) > 0 )
            {                
                while( $fila2 = mysqli_fetch_assoc( $resultado2 ) )
                {
                    //Se imprime cada categoría como un título.
                    //echo "<br><br><strong>".utf8_decode( $fila2[ 'categoria' ] )."</strong><br><br>";
                    echo "<br><br><strong>".utf8_decode( traer_regional( $fila2[ 'agrupador_suma' ] ) )." ".( $fila2[ 'conteo_participaciones' ] > 1 ? "( ".$fila2[ 'conteo_participaciones' ]." participaciones ).": "" )."</strong><br><br>";
                    
                    $imprimir = "";
                    $imprimir1 = "";
                    
                    $cambio1 = 0;
                    $cambio2 = 0;
                    $cambio3 = "<td>Regional o participante.</td>"; //$cambio3 = "<td>Regional</td>";
                    $numero_lugar = 0;
                    $tmp_cad = "";
                
                    //$sql  = " SELECT SUM( puntuacion ) AS total, jurado, nombre_region, categoria, ";
                    /*$sql  = " SELECT SUM( ROUND( puntuacion, 2 ) ) AS total, jurado, nombre_region, categoria, ";
                    $sql .= " ( SELECT COUNT( DISTINCT jurado ) FROM tb_calificaciones t2 WHERE t1.categoria = t2.categoria  ) AS conteo, ";
                    $sql .= " ( SELECT SUM( ROUND( puntuacion, 2 ) ) FROM tb_calificaciones t2 WHERE t1.categoria = t2.categoria AND t1.nombre_region = t2.nombre_region ) AS totales ";
                    $sql .= " FROM tb_calificaciones t1 ";
                    $sql .= " WHERE t1.categoria = '".$fila2[ 'categoria' ]."'";
                    $sql .= " GROUP BY nombre_region, categoria, jurado ";
                    $sql .= " ORDER BY categoria, totales DESC, nombre_region, jurado ";*/
                    
                    //22/05/2017 por Crivera.
                    $sql  = " SELECT SUM( ROUND( puntuacion, 2 ) ) AS total, jurado, "; //t11.agrupador_suma, ";
                    $sql .= " CASE WHEN ".$fila2[ 'conteo_participaciones' ]." > 1 THEN t11.agrupador_suma ELSE t1.nombre_region END as agrupador_suma,";
                    $sql .= " ( SELECT COUNT( DISTINCT jurado ) FROM tb_calificaciones t2 WHERE t1.categoria = t2.categoria  ) AS conteo, ";
                    
                    $sql .= " ( SELECT SUM( ROUND( puntuacion, 2 ) ) ";
                    $sql .= "   FROM tb_calificaciones t2, tb_regiones t22  ";
                    $sql .= "   WHERE t2.nombre_region = t22.nombre_region ";
                    if( $fila2[ 'conteo_participaciones' ] > 1 ){ $sql .= "   AND t22.agrupador_suma = t11.agrupador_suma "; }
                    else{
                            $sql .= " AND t2.categoria = '".$fila2[ 'agrupador_suma' ]."'";
                            $sql .= " AND t2.nombre_region = t11.nombre_region ";
                        }
                    $sql .= " ) AS totales ";
                    
                    $sql .= " FROM tb_calificaciones t1, tb_regiones t11 ";
                    if( $fila2[ 'conteo_participaciones' ] > 1 ){ $sql .= " WHERE t11.agrupador_suma = '".$fila2[ 'agrupador_suma' ]."'"; }
                    else{ $sql .= " WHERE t1.categoria = '".$fila2[ 'agrupador_suma' ]."'"; }
                    $sql .= " AND t1.nombre_region = t11.nombre_region ";
                    $sql .= " GROUP BY agrupador_suma, jurado ";
                    $sql .= " ORDER BY totales DESC, agrupador_suma, jurado ";
                    
                    //echo "<br>".$sql."<br>";
                    
                    $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                    $resultado = $conexion->query( $sql );
                    
                    //echo $sql;
                    
                    if( mysqli_num_rows( $resultado ) > 0 )
                    {               
                        $imprimir1  = "<table border='1px'>";                
                        $imprimir1 .= "<tr>";
                        
                        while( $fila = mysqli_fetch_assoc( $resultado ) )
                        {
                            if( strpos( $cambio3, $fila[ 'jurado' ] ) === false )
                            {
                                $cambio3 .= "<td><strong>".$fila[ 'jurado' ]."</strong></td>";
                            }
                            
                            /*if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                            {
                                $numero_lugar ++;
                                
                                if( $numero_lugar == 1 ){ $tmp_cad = "<img src='imagenes/1.gif'>"; }
                                else{ $tmp_cad = $numero_lugar.""; }
                                
                                $cambio1 .= $fila[ 'nombre_region' ];
                                $imprimir .= "<td><div style='padding: 7px; font-size: ".( 20 - $numero_lugar * 2 )."px;'> ".$tmp_cad."<strong> ".$fila[ 'nombre_region' ]."</strong></div></td>"; 
                            }*/
                            
                            if( strpos( $cambio1, $fila[ 'agrupador_suma' ] ) === false )
                            {
                                $numero_lugar ++; //Esta variable se encarga de mirar y a futuro colocar en qué lugar quedará el competidor.
                                
                                //Dependiendo del número de lugar, se puede colocar la copa del ganador o el número.
                                if( $numero_lugar == 1 ){ $tmp_cad = "<img src='imagenes/1.gif'>"; }
                                else{ $tmp_cad = $numero_lugar.""; }
                                
                                $cambio1 .= $fila[ 'agrupador_suma' ]; //$cambio1 .= $fila[ 'nombre_region' ];
                                
                                if( $fila2[ 'conteo_participaciones' ] <= 1 )
                                {
                                    //$imprimir .= "<td><strong>".$fila[ 'agrupador_suma' ]."</strong></td>";
                                    $imprimir .= "<td><div style='padding: 7px; font-size: ".( 20 - $numero_lugar * 2 )."px;'> ".$tmp_cad."<strong> ".$fila[ 'agrupador_suma' ]."</strong></div></td>"; 
                                    
                                }else{
                                        $imprimir .= "<td></td>";
                                    }
                            }
                            
                            $cambio2 ++;
                            
                            $imprimir .= "<td>";
                            //$imprimir .= $fila[ 'categoria' ]." ".$fila[ 'nombre_region' ]." ".$fila[ 'jurado' ]." ".$fila[ 'total' ]." "; //Para verificar.
                            $imprimir .= $fila[ 'total' ]." ";
                            $imprimir .= "</td>";
                            
                            if( $cambio2 % $fila[ 'conteo' ] == 0 )
                            {
                                //$imprimir .= "<td>".$fila[ 'totales' ]."</td>";
                                //Esto se ajusta porque el total total es un promedio de la suma de los puntajes sobre el número de participaciones.
                                $imprimir .= "<td>".( $fila[ 'totales' ] / $fila2[ 'conteo_participaciones' ] )."</td>";
                                $imprimir .= "</tr><tr>";
                            }
                        }
                        
                        $imprimir .= "</tr>";
                        $imprimir .= "</table>";
                    }
                    
                    echo $imprimir1."".$cambio3."<td><strong>Total</strong></td></tr><tr>".$imprimir;
            
                } //Fin del primer while y sql.
            
            } // Fin primer sql e if..
        
        ?>
        
        <?php  echo colocar_marca_adsi();  ?>
        
    </body>
</html>