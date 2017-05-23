<?php

    //Prueba para aplicar vectores en el programa.

    $i = 0;

    $vector[ 0 ][ 0 ] = "c";        $vector[ 0 ][ 1 ] = "a";
    $vector[ 1 ][ 0 ] = "b";        $vector[ 1 ][ 1 ] = "q";
    
    echo count( $vector )."<br>"; //Es importante saber cuantos elementos tiene el vector, de manera unidimensional.
    
    for( $i = 0; $i < count( $vector ); $i ++ )
    {
        echo $vector[ $i ][ 0 ]." ".$vector[ $i ][ 1 ]."<br>";
    }
?>