<form action="actualizar_valores.php?<?php echo "cat=".$_GET[ 'lista_categoria' ]."&jur=".$_GET[ 'lista_jurado' ]; ?>" method="POST">

      <?php
    include_once( "config.php" );
    include_once( "nucleo.php" );
    include 'clases/Operaciones.php';
    $mi_obj=new Operaciones; 
          //$url=  $_GET[ 'url_categoria' ] );
          //echo $url;
          //echo "<img src='".$url."'>";// .$_GET[ 'lista_jurado' ]."<br>";
          
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
          
          echo $sql;
          
          $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
          $resultado = $conexion->query( $sql );
          
          if( mysqli_num_rows( $resultado ) > 0 )
          {
              
              while( $fila = mysqli_fetch_assoc( $resultado ) )
              {
                  if( strpos( $cambio1, $fila[ 'nombre_region' ] ) === false )
                  {
                      $imprimir .= "<pane title='".$fila[ 'nombre_region' ]."'> ";
                      $imprimir .= "<table border='1px'>";                
                      $imprimir .= "<tr>";
                      $cambio1 .= $fila[ 'nombre_region' ];
                      $imprimir .= "<td>".$fila[ 'nombre_region' ]."</td>";
                      $cont_regionales ++;
                  }
                  
                  $cambio2 ++;
                  
                  $valor_control = traer_valor_control( "texto".$cambio2, $fila[ 'criterio' ], $_GET[ 'lista_categoria' ], $_GET[ 'lista_jurado' ], $fila[ 'nombre_region' ] );
                  
                  if( $valor_control * 1 == 0 ) $valor_control = ""; 
                  
                  //echo $valor_control."<br>";
                  //esto se modifica el 14/08/15 para que solo se pueda escribir numeros en la caja de texto. Efrain y Ricardo.
                  $imprimir .= "<td>";
                  $imprimir .= "<div class='contenedor-criterios-peque'>".utf8_decode( $fila[ 'criterio' ] )."</div>";
                  //$imprimir .= "<input class='entrada-texto' type='text' name='texto".$cambio2."' value='".$valor_control."' maxlength='3'>"; //Linea original Camilo F.
                  //$imprimir .= "<input class='entrada-texto' onkeypress='return soloNumeros(event) ' type='text' name='texto".$cambio2."' value='".$valor_control."' maxlength='2' placeholder='Max ".$fila[ 'porcentaje' ]."'>";
                  $imprimir .= "<input class='entrada-texto' onkeypress='return soloNumeros(event) ' type='text' name='texto".$cambio2."' value='".$valor_control."' maxlength='2'>";
                  $imprimir .= "<div class='contenedor-max-valores'> Max puntos: ".$fila[ 'porcentaje' ]."</div>";
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
                $imprimir .= "</tr>";
                $imprimir .= "</table>";
                $imprimir .= "</pane>";
                $imprimir .= "Jajajajajajajajajaja";
              }
              
              
              //Aquí se cuadra el conteo de regionales pero no se muestra al usuario.
              $imprimir .= "<br><input class='boton' type='hidden' name='cont_regionales' value='".$cont_regionales."' ><br>";
              
              echo $imprimir;
          }         
          
      ?>

      <br><br>
      
      <input class='boton' type="submit" value="Guardar">
</form>