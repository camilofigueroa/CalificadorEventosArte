<?php

    header('Content-Type: text/html; charset=UTF-8');
    include_once( "config.php" );
    include_once( "nucleo.php" );
    

?>

<html lang="ES">
    <head>
        <meta charset="ANSI" name="keywords" content="Zonal cultural Guaviare SENA"/>
        <title> Zonal regional Guaviare - menú inicio. </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
    <div class="container-fluid">
        
        <?php
            include 'encabezado.php';
        ?>
        <div id="contenedor-objetos">
            <div class="row">
                <div class="col-xs-12 col-md-1"></div>
                <div class="col-xs-12 col-md-3">
                    <center><img width="100%" src="imagenes/seleccione.png"></center>
                </div>
                <div class="col-xs-12 col-md-6"></div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-2"></div>
                <div class="col-xs-12 col-md-4 ">
                    <form action="calificaciones.php" method="GET">
                    
                        <?php
                        
                            //Se actualizan todos los valores a cero cuando el campo tiene un valor null.
                            $sql = " UPDATE tb_calificaciones SET puntuacion = 0 WHERE puntuacion is null; ";
                            $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                            $resultado = $conexion->query( $sql );
                            
                            
                            //A partir de aquí se colocarán las listas que un jurado podrá elegir para calificar.
                            $sql = "SELECT * FROM tb_jurados ORDER BY jurado ";
                            
                            //Conectamos con la base de datos.
                            $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                            $resultado = $conexion->query( $sql );
                            
                            //echo $sql;
                            
                            if( mysqli_num_rows( $resultado ) > 0 )
                            {
                                //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.
                                //echo "<li>Seleccione jurado por favor</li>";
                                echo "<SELECT class='form-control' name='lista_jurado' id='select_jurado' >";
                                echo "<option value='-1'>Seleccione jurado por favor</option>";                 
                                
                                while( $fila = mysqli_fetch_assoc( $resultado ) )
                                {                        
                                    echo "<option value='".$fila[ 'jurado' ]."'>".$fila[ 'jurado' ]."</option>";                 
                                }
            
                                //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.                    
                                echo "/<SELECT>"; 
                            }
                         ?>
                </div>
                <div class="col-xs-12 col-md-4">
                         <?php   
                            
                            $sql = "SELECT * FROM tb_categorias ORDER BY categoria ";
                            
                            //Conectamos con la base de datos.
                            $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                            $resultado = $conexion->query( $sql );
                            
                            //echo $sql;
                            
                            if( mysqli_num_rows( $resultado ) > 0 )
                            {
                                //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.
                                echo "<SELECT class='form-control' name='lista_categoria' id='select_jurado'>";
                                echo "<option value='-1'>Seleccione categoria a calificar por favor</option>";                 
                                
                                while( $fila = mysqli_fetch_assoc( $resultado ) )
                                {                        
                                    echo "<option value='".utf8_encode($fila[ 'categoria' ])."'>".utf8_encode( $fila[ 'categoria' ] )."</option>";                 
                                }
            
                                //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.                    
                                echo "/<SELECT>"; 
                            }
                        ?> 
                </div>       
                <div class="col-xs-12 col-md-2"></div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-xs-12 col-md-4"></div>
                <div class="col-xs-12 col-md-4">
                   <center><input class='btn btn-primary btn-lg' type="submit" value="Aceptar"></center> 
                </div>
                <div class="col-xs-12 col-md-4"></div>
            </div>
                
                            
                    
                    </form>
                    
               
            <br>
            
            
        </div>
        <br>
        <div class="row well">
            <?php echo colocar_marca_adsi(); ?>
        </div>
        
    </div>    
    </body>    
</html>