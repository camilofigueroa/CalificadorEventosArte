<?php

    //Se incluyen los parámetros a traves de config.php y las funciones a través de nucleo.php
    include_once( "config.php" );
    include_once( "nucleo.php" );
    header('Content-Type: text/html; charset=UTF-8');
?>

<html>
    <head>
        <title> Zonal regional Guaviare - totales. </title>
    
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    
    <body>
        <div class="container-fluid">
            <?php include 'encabezado.php'; ?>

        <div class="container">
        <?php
            
                    echo "<h1> <center><b>TOTAL | </b><h3> <a href='pdf.php'>PDF Resultados</a></h3></center> </h1>";
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
                    echo "<br><br><strong><h2>".utf8_encode( $fila2[ 'categoria' ] )."</h2></strong><br><br>";
                    
                    $imprimir = "";
                    $imprimir1 = "";
                    
                    $cambio1 = 0;
                    $cambio2 = 0;
                    $cambio3 = "<td>Regional</td>";
                    $numero_lugar = 0;
                    $tmp_cad = "";
                
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
                        //$imprimir = "<div class='row'>" ;
                        //$imprimir .= "<div class='col-xs-12 col-md-3></div>'";
                        //$imprimir .= "<div class='col-xs-12 col-md-6>'";
                        $imprimir1  .= "<table border='1px' class='table'>";                
                        $imprimir1 .= "<tr>";
                        
                        while( $fila = mysqli_fetch_assoc( $resultado ) )
                        {
                            if( strpos( $cambio3, $fila[ 'jurado' ] ) === false )
                            {
                                $cambio3 .= "<td><strong>".$fila[ 'jurado' ]."</strong></td>";
                            }
                            
                            if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                            {
                                $numero_lugar ++;
                                
                                if( $numero_lugar == 1 ){ $tmp_cad = "<img src='imagenes/1.gif'>"; }
                                else{ $tmp_cad = $numero_lugar.""; }
                                
                                $cambio1 .= $fila[ 'nombre_region' ];
                                $imprimir .= "<td><div style='padding: 7px; font-size: ".( 20 - $numero_lugar * 2 )."px;'> ".$tmp_cad."<strong> ".$fila[ 'nombre_region' ]."</strong></div></td>"; 
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
                        //$imprimir = "</div>";
                        //$imprimir .= "<div class='col-xs-12 col-md-3></div>'";
                        //$imprimir = "</div>";
                    }
                    
                    echo $imprimir1."".$cambio3."<td><strong>Total</strong></td></tr><tr>".$imprimir;
            
                } //Fin del primer while y sql.
            
            } // Fin primer sql e if..
        
        ?>
        </div>   
        
        <?php  echo colocar_marca_adsi();  ?>
        </div>
        
    </body>
</html>