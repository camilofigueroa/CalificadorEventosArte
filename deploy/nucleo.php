<?php

    set_time_limit( 300 );  //Por Edwin Leon, Yimer Moreno y Anderson Rodriguez.
    
    function imprimir_titulo( $titulo )
    {
        echo "<div class='contenedor-titulo'>".$titulo."</div><br><br>";
    }
    
    function colocar_logo()
    {
        echo "<img src='imagenes/logo.png'><br><br>";
    }
    
    function imprimir_menu()
    {
        colocar_logo();
        
        echo "<a href='index.php'> Inicio </a>";
        echo "<a href='totales.php'> Totales </a>";
        echo "<br><br>";
    }


    function actualizar_controles( $nombre_input, $criterio, $categoria, $jurado, $nombre_region )
    {
        include( "config.php" );
        
        $sql  = " UPDATE tb_calificaciones SET text_input_name = '$nombre_input' ";
        $sql .= " WHERE criterio        = '".$criterio."'";
        $sql .= " AND   categoria       = '".$categoria."'";
        $sql .= " AND   jurado          = '".$jurado."'";
        $sql .= " AND nombre_region     = '".$nombre_region."'";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );
    }
    
    function traer_valor_control( $nombre_input, $criterio, $categoria, $jurado, $nombre_region )
    {
        include( "config.php" );
        
        $respuesta = 0;
        
        $sql  = " SELECT puntuacion FROM tb_calificaciones ";
        $sql .= " WHERE text_input_name = '".$nombre_input."' ";
        $sql .= " AND criterio          = '".$criterio."' ";
        $sql .= " AND categoria         = '".$categoria."' ";
        $sql .= " AND jurado            = '".$jurado."' ";
        $sql .= " AND nombre_region     = '".$nombre_region."' ";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );
        
        if( mysqli_num_rows( $resultado ) > 0 )
        {            
            while( $fila = mysqli_fetch_assoc( $resultado ) )
            {
                //echo "Entrando al recorset.";
                $respuesta = $fila[ 'puntuacion' ]."";
                //echo $fila[ 'puntuacion' ];
            }
        }
        
        return $respuesta."";
    }

    function actualizar_valor_control( $nombre_input, $categoria, $jurado, $puntuacion )
    {
        include( "config.php" );
        
        $respuesta = 0;
        
        $sql  = " UPDATE tb_calificaciones ";
        $sql .= " SET puntuacion = ".$puntuacion;
        $sql .= " WHERE text_input_name = '".$nombre_input."'";
        $sql .= " AND   categoria       = '".$categoria."'";
        $sql .= " AND   jurado          = '".$jurado."'";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );
        
        //return $respuesta."";
    }

    function traer_categorias()
    {
        include( "config.php" );
        
        $respuesta = "";
        
        $sql  = " SELECT categoria FROM tb_categorias ";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );

        if( mysqli_num_rows( $resultado ) > 0 )
        {
            while( $fila = mysqli_fetch_assoc( $resultado ) )
            {   
                //$respuesta .= "<|c|>".TRIM( $fila[ 'categoria' ] ); // c de campo
                $respuesta .= "<|r|>".TRIM( $fila[ 'categoria' ] ); 
                //$respuesta .= "<|r|>"; // r de registro.
            }
        }
        
        return $respuesta."";
    }
    
    function traer_regionales()
    {
        include( "config.php" );
        
        $respuesta = "";
        
        $sql  = " SELECT nombre_region FROM tb_regiones ";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );

        if( mysqli_num_rows( $resultado ) > 0 )
        {
            while( $fila = mysqli_fetch_assoc( $resultado ) )
            {   
                //$respuesta .= "<|c|>".TRIM( $fila[ 'categoria' ] ); // c de campo
                $respuesta .= "<|r|>".TRIM( $fila[ 'nombre_region' ] ); 
                //$respuesta .= "<|r|>"; // r de registro.
            }
        }
        
        return $respuesta."";
    }
    
    function guardar_foto( $nombre_region, $categoria, $url )
    {
        include( "config.php" );
        
        $error = "";
        
        $sql  = " INSERT INTO tb_imagenes( nombre_region, categoria, url ) ";
        $sql .= " VALUES( '$nombre_region', '$categoria', '$url' ) ";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );

        if( $conexion->affected_rows > 0 ){ $error = "1; La información de la fotografía se ha guardado correctamente."; }
        else{ $error = "1; Error: No se ha guardado la información de la foto. Es probable que esa regional no participe en esa categoría, que no haya escogido de las listas o algún otro error desconocido."; }
        
        //return $sql."";
        return $error."";
    }
    
    function traer_imagenes( $categoria )
    {
        include( "config.php" );
        
        $respuesta = "";
        $cambio1 = "";
        
        $sql  = " SELECT * FROM tb_imagenes ";
        $sql .= " WHERE categoria = '".TRIM( $categoria )."' ";
        $sql .= " AND nombre_region in ( SELECT DISTINCT nombre_region FROM tb_calificaciones WHERE categoria = '".TRIM( $categoria )."' )";
        $sql .= " ORDER BY nombre_region, categoria ";
        
        //echo $sql."<br>";
        
        $conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
        $resultado = $conexion->query( $sql );
        
        if( mysqli_num_rows( $resultado ) > 0 )
        {
            while( $fila = mysqli_fetch_assoc( $resultado ) )
            {
                if( strpos( $cambio1, $fila[ 'nombre_region' ]."" ) === false )
                {
                    $cambio1 .= $fila[ 'nombre_region' ];
                    $respuesta .= "<br><br><br>".$fila[ 'nombre_region' ]."<br>";    
                }               
                
                $respuesta .= "<br><img src='".TRIM( $fila[ 'url' ] )."'>";
                //$respuesta .= "<br>".TRIM( $fila[ 'url' ] ); 
            }
            
        }else{
            
            $respuesta = "<br><br>No se han encontrado fotos para esta categoría y regional.<br><br>";
        }
        
        return $respuesta;
    }
    
    function colocar_marca_adsi()
    {
        $respuesta = "";
        
        $respuesta .= "<br><br>";
        $respuesta .= " <img src='imagenes/9.png'> ";
        
        return $respuesta;
    }

?>