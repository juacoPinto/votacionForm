<?php
require './conection.php';

//CONSULTA PARA OBTENER LAS REGIONES
$consultaRegiones = "SELECT * FROM regiones";
$resultadoRegiones = mysqli_query($conexion, $consultaRegiones);

//CONSULTA PARA OBTENER LOS CANDIDATOS
$consultaCandidatos = "SELECT * FROM candidatos";
$resultadoCandidatos = mysqli_query($conexion, $consultaCandidatos);

//SE TOMAN LOS VALORES DE LOS IMPUTS Y GRABAMOS EN DB SI TODOS ESTAN CORRECTOS
if(isset($_POST['buttonSubmit'])){
    $nombre = $_POST['nombre'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $regiones = $_POST['regiones'];
    $comunas = $_POST['comunas'];
    $candidatos = $_POST['candidatos'];
    $contactos = $_POST['contacto'];
    $string = "";

    //FORMATEANDO EL MULTIPLE CHECKBOX
    foreach($contactos as $contactoItem){
        $string =  $string . " " .$contactoItem;
    };

    //CONSULTAR SI EL RUT YA SE ENCUENTRA REGISTRADO
    $validarRut = "SELECT * FROM votos WHERE rut = '$rut'";
    $validarRutResultado = mysqli_query($conexion, $validarRut);

    if(mysqli_num_rows($validarRutResultado) > 0){
        echo "Este rut ya se uso para votar";
    } else {
        //CONSULTA PARA INSERTAR LOS DATOS
        $query = "INSERT INTO votos(rut,nombre,alias,email,region,comuna,candidato,contacto) VALUES('$rut','$nombre','$alias','$email','$regiones','$comunas','$candidatos','$string');";
        $resultado = mysqli_query($conexion, $query);

        if($resultado){
            echo "Voto Agregado";
        }else {
            echo "Llene todos los campos para ingresar su voto";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votacion</title>
    <script
        src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous">
    </script>
</head>
<body>
    <div>
        <form method="POST" >
            <fieldset>FORMULARIO DE VOTACION</fieldset>
            <label for="nombre">Nombre y Apellido</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre">
            <br>
            <label for="alias">Alias</label>
            <input type="text" placeholder="Tu alias" id="alias" name="alias">
            <br>
            <label for="rut">Rut</label>
            <input type="text" placeholder="Sin puntos ni guion" id="rut" name="rut">
            <br>
            <label for="email">Email</label>
            <input type="text" placeholder="Tu Email" id="email" name="email">
            <br>
            <label for="regiones">Region</label>
            <select id="regiones" name="regiones" onChange="getComuna(this.value);">
                <option value="" disabled selected>-- Seleccione su Region --</option>
                <?php while($region = mysqli_fetch_assoc($resultadoRegiones)) : ?>
                    <option id="region-generada" value="<?php echo $region['id'] ?>" > <?php echo $region['region']. "  " .$region['id']?> </option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="comunas">Comuna</label>
            <select id="comunas" name="comunas">
                <option value="" disabled selected>-- Seleccione su Comuna --</option>
            </select>
            <br>
            <label for="candidatos">Candidato</label>
            <select id="candidatos" name="candidatos">
                <option value="" disabled selected>-- Seleccione su Candidato --</option>
                <?php while($candidato = mysqli_fetch_assoc($resultadoCandidatos)) : ?>
                    <option id="candidato-generado" value="<?php echo $candidato['id'] ?>" > <?php echo $candidato['nombre'] ?> </option>
                <?php endwhile ?>
            </select>
            <br>
            <div>
                <p>Como se entero de Nosotros</p>
                <label for="contactar-web">Web</label>
                <input name="contacto[]" type="checkbox" value="web" id="contactar-web">

                <label for="contactar-tv">Tv</label>
                <input name="contacto[]" type="checkbox" value="tv" id="contactar-tv">
                
                <label for="contactar-redes">Redes Sociales</label>
                <input name="contacto[]" type="checkbox" value="redes" id="contactar-redes">

                <label for="contactar-amigo">Amigo</label>
                <input name="contacto[]" type="checkbox" value="amigo" id="contactar-amigo">
            </div>
            <br>
            <input type="submit" name="buttonSubmit" value="Votar" id="botonEnviar">
        </form>
    </div>
</body>
<script src="js/index.js" ></script>

</html>