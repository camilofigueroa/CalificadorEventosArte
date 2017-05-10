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
            $sql  = " SELECT DISTINCT categoria FROM tb_calificaciones ORDER BY categoria ";
                        
            $conexion2 = mysqli_connect( $servidor, $usuario, $clave, $bd );
            $resultado2 = $conexion2->query( $sql );
            
            //echo $sql;
                       
            if( mysqli_num_rows( $resultado2 ) > 0 )
            {                
                while( $fila2 = mysqli_fetch_assoc( $resultado2 ) )
                {
                    //Se imprime cada categoría como un título.
                    echo "<br><br><strong>".utf8_decode( $fila2[ 'categoria' ] )."</strong><br><br>";
                    
                    $imprimir = "";
                    $imprimir1 = "";
                    
                    $cambio1 = 0;
                    $cambio2 = 0;
                    $cambio3 = "<td>Regional</td>";
                
                    //$sql  = " SELECT SUM( puntuacion ) AS total, jurado, nombre_region, categoria, ";
                    $sql  = " SELECT SUM( ROUND( puntuacion, 2 ) ) AS total, jurado, nombre_region, categoria, ";
                    $sql .= " ( SELECT COUNT( DISTINCT jurado ) FROM tb_calificaciones t2 WHERE t1.categoria = t2.categoria  ) AS conteo, ";
                    $sql .= " ( SELECT SUM( ROUND( puntuacion, 2 ) ) FROM tb_calificaciones t2 WHERE t1.categoria = t2.categoria AND t1.nombre_region = t2.nombre_region ) AS totales ";
                    $sql .= " FROM tb_calificaciones t1 ";
                    $sql .= " WHERE t1.categoria = '".$fila2[ 'categoria' ]."'";
                    $sql .= " GROUP BY nombre_region, categoria, jurado ";
                    $sql .= " ORDER BY categoria, totales DESC, nombre_region, jurado ";
                    
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
                            
                            if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                            {
                                $cambio1 .= $fila[ 'nombre_region' ];
                                $imprimir .= "<td><strong>".$fila[ 'nombre_region' ]."</strong></td>"; 
                            }
                            
                            $cambio2 ++;
                            
                            $imprimir .= "<td>";
                            //$imprimir .= $fila[ 'categoria' ]." ".$fila[ 'nombre_region' ]." ".$fila[ 'jurado' ]." ".$fila[ 'total' ]." "; //Para verificar.
                            $imprimir .= $fila[ 'total' ]." ";
                            $imprimir .= "</td>";
                            
                            if( $cambio2 % $fila[ 'conteo' ] == 0 )
                            {
                                $imprimir .= "<td>".$fila[ 'totales' ]."</td>";
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