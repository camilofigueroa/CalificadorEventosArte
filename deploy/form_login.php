<?php

    header('Content-Type: text/html; charset=UTF-8');
    include_once( "config.php" );
    include_once( "nucleo.php" );
    

?>
<html lang="ES">
    <head>
        <meta charset="ANSI" name="keywords" content="Zonal cultural Guaviare SENA"/>
        <title> Zonal regional Guaviare - Login. </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
    </head>
    
    <body>
    <div class="container-fluid">
        
                <div class="row" id="row">
                <div class="col-xs-12 col-md-3" id="contenerdor_logo">
                    <?php echo colocar_logo(); ?>                
                </div>
                <div class="col-xs-12 col-md-6"></div>
                <div class="col-xs-12 col-md-3">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        
                    </div>
                    <div class="col-xs-6 col-md-6">

                    </div>
                </div>  
                <div class="row">
                    <div class="col-xs-hidden col-md-12">
                        <center>
                            <img width="100%" src="imagenes/logos.png">
                        </center>
                    </div>
                </div>  
                </div>
        </div>

        <div class="row">
            <div id="encabezado">
                Bienvenid@ | <b>San José del Guaviare - Guaviare</b>
            </div>
        </div>

        <!-- Inicia el form -->
        <div id="contenedor-objetos">
            <!-- <div class="row">
                <div class="col-xs-12 col-md-1"></div>
                <div class="col-xs-12 col-md-3">
                    <center><img width="100%" src="imagenes/seleccione.png"></center>
                </div>
                <div class="col-xs-12 col-md-6"></div>
            </div> -->
            <div class="login">
              <div class="login-triangle"></div>
              
              <h2 class="login-header">Log in</h2>

              <form class="login-container">
                <p><input type="text" name="user" placeholder="User" required></p>
                <p><input type="password" name="pass" placeholder="Password" required></p>
                <p><input type="submit" value="Log in"></p>
              </form>
            </div>
            <?php 
                if ($_GET) {
                    $user = $_GET['user'];
                    $pass = $_GET['pass'];
                    if ($user === "Sena" && $pass === "2017") {
                        header('location:desktop.php');
                    }else if ($user === "ADMIN" && $pass === "admin") {
                        header('location:foto');
                    }else if ($user === "QFin" && $pass === "1120582706") {
                        header('location:totales.php');
                    }else{
                        echo "<script>alert('Usuario ó password incorrectos')</script>";
                    }
                }
             ?>     
        <br>
        <div class="row well">
            <?php echo colocar_marca_adsi(); ?>
        </div>
        
    </div>    
    </body>    
</html>