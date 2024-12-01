<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruver_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

session_start();
$varsesion = $_SESSION['id'];

$$sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', correo='$email', contraseña='$contraseña', fecha_nacimiento='$fecha_nacimiento' WHERE correo='$varsesion'";

if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados correctamente.";
} else {
    echo "Error al actualizar datos: " . $conn->error; // Mostrar el error de MySQL
}


$conn->close();


?>
