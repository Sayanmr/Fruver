<link rel="stylesheet" href="../css/login.css?v=1.1">
<?php
include('db.php');
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['correo'] = $correo;

$conexion = mysqli_connect("localhost", "root", "", "fruver_db");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$consulta = "SELECT * FROM usuario WHERE correo='$correo' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    $filas = mysqli_fetch_array($resultado);


    if ($filas) {
        if ($filas['id_cargo'] == 2) {
            header("Location: ../usuario/perfil.php");
        } elseif ($filas['id_cargo'] == 1) {
            header("Location: ../admin/adminperfil.php");
        }
    } else {
        include("login.php");
        echo "<h1 class='bad'>Error en la Autenticacion</h1>";
    }
} else {
    echo "Error in query: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
