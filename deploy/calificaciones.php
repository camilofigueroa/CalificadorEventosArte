<?php

    include_once( "config.php" );
    include_once( "nucleo.php" );
    include 'clases/Operaciones.php';
    $mi_obj=new Operaciones;

    //if( isset( $_GET[ 'lista_categoria' ] ) )
    if( isset( $_GET[ 'lista_jurado' ] ) && isset( $_GET[ 'lista_categoria' ] ) )
    {
        
        //Si no se han escogido valores de la lista, retornar al anterior formulario para que escojan.
        if( $_GET[ 'lista_categoria' ] == -1 || $_GET[ 'lista_jurado' ] == -1 )
        header( "location: desktop.php" );
    
?>


<html ng-app="app">
    <head>
        <title>
            Zonal regional Guaviare - Panel de calificaciones.
        </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
        <script src="js/angular.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-combined.min.css">
          <script src="js/componentes.js"></script>
          <script src="js/app.js"></script>
        <!-- Este código en javascript fue suministrado por Efrain y Ricardo, pero solo funciona en Chrome. -->
        <script language="JavaScript" type="text/JavaScript">
        //esto se modifica el 18/08/15 para que solo se pueda escribir numeros en la caja de texto
        function num(e) {
            evt = e ? e : event;
            tcl = (window.Event) ? evt.which : evt.keyCode;
            if ((tcl < 48 || tcl > 57) && (tcl != 8 && tcl != 0 && tcl != 46))
            {
                return false;
            }
            return true;
        }
        //hasta ca va el codigo de funcion para solo numeros en la linea 97 ala 100 esta el resto
        </script>        
        
    </head>
    
    <body>
        <div class="container-fluid">
            <?php
                include 'encabezado.php';
            ?>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <?php echo "<b><h3>".$_GET[ 'lista_jurado' ]."</h3></b>"; ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <?php
                        $categoria = utf8_decode($_GET[ 'lista_categoria' ]);
                        echo $mi_obj->mostrar_imagen('tb_categorias', '*', "categoria = '$categoria' ");
                    ?>
                    
                </div>
                <div class="col-xs-12 col-md-4"></div>
            </div>

            <div class="row">
              <div class="col-xs-12 col-md-12">
                
                <form action="actualizar_valores.php?<?php echo "cat=".$_GET[ 'lista_categoria' ]."&jur=".$_GET[ 'lista_jurado' ]; ?>" method="POST">
              <tabs>

      <?php
          
          $imprimir = "";
          $cambio1 = 0;
          $cambio2 = 0;
          $cont_regionales = 0;
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
          
          //echo mysqli_num_rows($resultado);
          if( mysqli_num_rows( $resultado ) > 0 )
          {
              
              while( $fila = mysqli_fetch_assoc( $resultado ) )
              {
                  if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                  {
                      $imprimir .= "<pane title='".$fila[ 'nombre_region' ]."'> ";
                      $cambio1 .= $fila[ 'nombre_region' ];
                      $nombre_region = $fila[ 'nombre_region' ];
                      $cont_regionales ++;
                        $imprimir .= "<div class='container'>";
                      $imprimir .= "<div class='row'>";
                        $imprimir .= "<div class='col-xs-12 col-md-6'>";
                        $imprimir .= "<h3 class='center'>".$fila[ 'nombre_region' ]."</h3>";
                  }
                  
                  $cambio2 ++;
                  
                  $valor_control = traer_valor_control( "texto".$cambio2, $fila[ 'criterio' ], $_GET[ 'lista_categoria' ], $_GET[ 'lista_jurado' ], $fila[ 'nombre_region' ] );
                  
                  if( $valor_control * 1 == 0 ) $valor_control = ""; 
                  
                  
                  $imprimir .= "<div class='col-xs-6 col-md-6 well'>";
                    $imprimir .= "  <label>".utf8_decode( $fila[ 'criterio' ] )."</label>";
                    $imprimir .= "  <input  onkeypress='return num(event);' class='form-control  type='number' name='texto".$cambio2."' value='".$valor_control."' maxlength='2'>";
                    $imprimir .= "  <span class='badge badge-success'>Max puntos: ".$fila[ 'porcentaje' ]."</span>";
                    $imprimir .= "<div class='contenedor-avisos-peque'>texto".$cambio2."</div>";
                  $imprimir .= "</div>";

                  actualizar_controles( "texto".$cambio2, $fila[ 'criterio' ], $_GET[ 'lista_categoria' ], $_GET[ 'lista_jurado' ], $fila[ 'nombre_region' ] );
                  
                  if( $cambio2 % $fila[ 'cont_cat' ] == 0 )
                  {
                      
                      $imprimir .= "<div class='contenedor-criterios-peque' style='color:red'>Total</div>";
                      $imprimir .= "<div class='contenedor-totales' style='color:red'> ";
                      $imprimir .= $fila[ 'total' ];
                      $imprimir .= "</div>";
                      $imprimir .= "</div>";
                        $imprimir .= "<div class='col-xs-12 col-md-6'>";
                            $imprimir .= "<div class='row' ><br>";
                                  $imprimir .= "<h3>Galer&iacute;a </h3>";
                                  $imprimir .= traer_imagenes( $_GET[ 'lista_categoria' ] , $nombre_region );
                            $imprimir .= "</div>";
                        $imprimir .= "</div>";
                      $imprimir .= "</div>";
                      //$imprimir .= "</div>";
                      $imprimir .= "</div>";
                      $imprimir .= "<br><input class='boton' type='hidden' name='cont_regionales' value='".$cont_regionales."' >";
                      echo $imprimir;
                      echo  "</pane>";
                      $imprimir="";
                  }                   
              }
              
              
              //Aquí se cuadra el conteo de regionales pero no se muestra al usuario.
              
              //echo $imprimir;
          }         
          
      ?>

      <br>
      
             <center><input id="btn_calificar" class='btn btn-success ' type="submit" value="CALIFICAR"></center>
        </tabs>
        </form>
       </div>             
      </div>
            
            
            <br><br>
            
            
            <br>
            <div class="row well">
                <?php echo colocar_marca_adsi(); ?>
            </div>
        </div> 
    </body>
</html>

<?php

    } //Cerrando el if de existencia de lista_categoria y lista_jurado

?>