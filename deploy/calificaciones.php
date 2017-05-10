<?php

    include_once( "config.php" );
    include_once( "nucleo.php" );

    //if( isset( $_GET[ 'lista_categoria' ] ) )
    if( isset( $_GET[ 'lista_jurado' ] ) && isset( $_GET[ 'lista_categoria' ] ) )
    {
        
        //Si no se han escogido valores de la lista, retornar al anterior formulario para que escojan.
        if( $_GET[ 'lista_categoria' ] * 1 < 0 || $_GET[ 'lista_jurado' ] * 1 < 0 )
        header( "location: index.php" );
    
?>


<html>
    <head>
        <title>
            Zonal regional Guaviare - Panel de calificaciones.
        </title>
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
        
        <!-- Este código en javascript fue suministrado por Efrain y Ricardo, pero solo funciona en Chrome. -->
        <script language="JavaScript" type="text/JavaScript">
        //esto se modifica el 18/08/15 para que solo se pueda escribir numeros en la caja de texto
        function soloNumeros(evt) {
            evt = (evt) ? evt : event;
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
                ((evt.which) ? evt.which : 0));
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                alert("Sólo números, por favor"); //se puede quitar
                return false;
            }
            return true;
        }
        //hasta ca va el codigo de funcion para solo numeros en la linea 97 ala 100 esta el resto
        </script>        
        
    </head>
    
    <body>
        
        
        <?php
            imprimir_menu();
            imprimir_titulo( "Zonal cultural Guaviare" );
        ?>
        
        <form action="actualizar_valores.php?<?php echo "cat=".$_GET[ 'lista_categoria' ]."&jur=".$_GET[ 'lista_jurado' ]; ?>" method="POST">
        
            <?php
            
                echo utf8_decode( $_GET[ 'lista_categoria' ] )." - ".$_GET[ 'lista_jurado' ]."<br>";
                
                $imprimir = "";
                
                $cambio1 = 0;
                $cambio2 = 0;
                $valor_control = "";
                
                $sql  = " SELECT *, ";
                $sql .= " ( SELECT COUNT( * ) FROM tb_criterios t6 WHERE LEFT( t6.indicador_categoria, 1 ) = LEFT( t5.categoria, 1 )  ) AS cont_cat, ";
                $sql .= " ( SELECT SUM( ROUND( puntuacion, 2 ) ) FROM tb_calificaciones t6 WHERE t1.categoria = t6.categoria AND t1.jurado = t6.jurado AND t1.nombre_region = t6.nombre_region ) AS total ";
                $sql .= " FROM tb_calificaciones t1, tb_jurados t2, tb_criterios t3, tb_regiones t4, tb_categorias t5 ";
                $sql .= " WHERE t1.jurado = t2.jurado ";
                $sql .= " AND   t1.criterio = t3.criterio ";
                $sql .= " AND   t1.nombre_region = t4.nombre_region ";
                $sql .= " AND   t1.categoria = t5.categoria ";
                $sql .= " AND   t1.categoria LIKE '%".$_GET[ 'lista_categoria' ]."%' ";
                $sql .= " AND   t1.jurado LIKE '%".$_GET[ 'lista_jurado' ]."%' ";
                $sql .= " ORDER BY t1.nombre_region, t3.criterio ";
                
                //echo $sql;
                
                $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                $resultado = $conexion->query( $sql );
                
                if( mysqli_num_rows( $resultado ) > 0 )
                {
                    $imprimir .= "<table border='1px'>";                
                    $imprimir .= "<tr>";
                    
                    while( $fila = mysqli_fetch_assoc( $resultado ) )
                    {
                        if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                        {
                            $cambio1 .= $fila[ 'nombre_region' ];
                            $imprimir .= "<td>".$fila[ 'nombre_region' ]."</td>";
                        }
                        
                        $cambio2 ++;
                        
                        $valor_control = traer_valor_control( "texto".$cambio2, $fila[ 'criterio' ], $_GET[ 'lista_categoria' ], $_GET[ 'lista_jurado' ], $fila[ 'nombre_region' ] );
                        
                        //echo $valor_control."<br>";
                        //esto se modifica el 14/08/15 para que solo se pueda escribir numeros en la caja de texto. Efrain y Ricardo.
                        $imprimir .= "<td>";
                        $imprimir .= "<div class='contenedor-criterios-peque'>".utf8_decode( $fila[ 'criterio' ] )."</div>";
                        //$imprimir .= "<input class='entrada-texto' type='text' name='texto".$cambio2."' value='".$valor_control."' maxlength='3'>"; //Linea original Camilo F.
                        $imprimir .= "<input class='entrada-texto' onkeypress='return soloNumeros(event) ' type='text' name='texto".$cambio2."' value='".$valor_control."' maxlength='2'>";
                        $imprimir .= "<div class='contenedor-avisos-peque'>texto".$cambio2."</div>";
                        $imprimir .= "</td>";
                        
                        actualizar_controles( "texto".$cambio2, $fila[ 'criterio' ], $_GET[ 'lista_categoria' ], $_GET[ 'lista_jurado' ], $fila[ 'nombre_region' ] );
                        
                        if( $cambio2 % $fila[ 'cont_cat' ] == 0 )
                        {
                            
                            $imprimir .= "<td>";
                            $imprimir .= "<div class='contenedor-criterios-peque'>Total</div>";
                            $imprimir .= "<div class='contenedor-totales'> ";
                            $imprimir .= $fila[ 'total' ];
                            $imprimir .= "</div>";
                            $imprimir .= "</td>";
                            $imprimir .= "</tr><tr>";
                        }                   
                    }
                    
                    $imprimir .= "</tr>";
                    $imprimir .= "</table>";
                    
                    echo $imprimir;
                }         
                
            ?>
    
            <br><br>
            
            <input type="submit" value="Actualizar">
        
        </form>
        
        <br><br>
        
        <?php
            imprimir_titulo( "Galería de fotos." );    
            echo traer_imagenes( $_GET[ 'lista_categoria' ] );
        ?>
        
        <?php  echo colocar_marca_adsi();  ?>
        
    </body>
</html>

<?php

    } //Cerrando el if de existencia de lista_categoria y lista_jurado

?>