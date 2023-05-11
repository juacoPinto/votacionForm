<?php
require './conection.php';

if(!empty($_POST["region_id"])){
    //QUERY CONSULTA QUE HACE LA RELACION CON LA TABLA PROVINCIAS, SOLO PARA MAYOR ORDEN.
    $consultaComunas = "SELECT  *  FROM comunas INNER JOIN provincias ON  comunas.provincia_id = provincias.id INNER JOIN regiones ON provincias.region_id = regiones.id WHERE regiones.id = ".$_POST["region_id"]."";
    
    $resultadoComunas = mysqli_query($conexion, $consultaComunas);
    $comunasCount = mysqli_fetch_all($resultadoComunas);
?>
<option value disabled selected >Selecciona Comuna </option>

<?php
    foreach($comunasCount as $comuna){
        ?>
    <option id="comuna-generada" value="<?php echo $comuna[0] ?>" > <?php echo $comuna[1] ?> </option>
    <?php
    }
}
?>