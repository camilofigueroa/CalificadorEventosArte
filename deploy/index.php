<?php

    include_once( "config.php" );
    include_once( "nucleo.php" );

?>

<html>
    <head>
        <meta charset="ANSI" name="keywords" content="Zonal cultural Guaviare SENA"/>
        <title> Zonal regional Guaviare - menú inicio. </title>
        
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
        
        <div id="contenedor-objetos">
            
            <?php
                imprimir_menu();
                imprimir_titulo( "Zonal cultural Guaviare" );
            ?>
            
            <br>
                Por favor elegir un valor de cada una de las listas.
            <br><br>
            
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
                        echo "<SELECT name='lista_jurado'>";
                        echo "<option value='-1'>Seleccione jurado por favor</option>";                 
                        
                        while( $fila = mysqli_fetch_assoc( $resultado ) )
                        {                        
                            echo "<option value='".$fila[ 'jurado' ]."'>".$fila[ 'jurado' ]."</option>";                 
                        }
    
                        //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.                    
                        echo "/<SELECT>"; 
                    }
                    
                    echo "<br><br>";
                    
                    $sql = "SELECT * FROM tb_categorias ORDER BY categoria ";
                    
                    //Conectamos con la base de datos.
                    $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
                    $resultado = $conexion->query( $sql );
                    
                    //echo $sql;
                    
                    if( mysqli_num_rows( $resultado ) > 0 )
                    {
                        //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.
                        echo "<SELECT name='lista_categoria'>";
                        echo "<option value='-1'>Seleccione categoria a calificar por favor</option>";                 
                        
                        while( $fila = mysqli_fetch_assoc( $resultado ) )
                        {                        
                            echo "<option value='".$fila[ 'categoria' ]."'>".utf8_decode( $fila[ 'categoria' ] )."</option>";                 
                        }
    
                        //El inicio y fin de la lista se coloca fuera del ciclo while para que abarque todo lo que arroje la consulta.                    
                        echo "/<SELECT>"; 
                    }
                ?>        
            
                <br><br>
                    
                <input type="submit" value="Aceptar">
            
            </form>
            
        </div>
        
        <?php  echo colocar_marca_adsi();  ?>
        
    </body>    
</html>