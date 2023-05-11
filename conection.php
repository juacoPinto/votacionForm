<?php
$conexion = mysqli_connect("localhost","root","","Votacion");
if(!$conexion){
    echo mysqli_connect_error();
}else {
    //echo "Conexion Exitosa";
}
?>