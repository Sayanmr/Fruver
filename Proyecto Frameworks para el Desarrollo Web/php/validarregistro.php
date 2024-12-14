<?php
include('db.php');
if (!empty($_POST['btnregistrar'])){
if (!empty($_POST['nombre']) and !empty($_POST["apellido"]) and !empty($_POST["correo"]) and !empty($_POST["contraseña"]) and !empty($_POST["fecha"])) {;

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$fecha_nacimiento = $_POST['fecha'];


$conexion=mysqli_connect("localhost","root","","fruver_db");

$consulta = "SELECT * FROM usuario WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    echo '<div class="alert alert-warning">El correo ya está registrado. Por favor, use otro correo.</div>';
} else {
    $sql = $conexion->query("INSERT INTO usuario (nombre, apellido, correo, contraseña, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$correo', '$contraseña', '$fecha_nacimiento')");

    if ($sql) {
        header("location:login.php");
    } else {
        echo '<div class="alert alert-danger">Error al registrar persona.</div>';
    }
}

} else {
echo '<div class="alert alert-warning">Complete todos los campos.</div>';
}
}
?>
