<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location:../php/login.php");
    exit();
}

$correo = $_SESSION['correo'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruver_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    $sql_user = "SELECT id FROM usuario WHERE correo = '$correo'";
    $result_user = $conn->query($sql_user);
    if ($result_user->num_rows > 0) {
        $user = $result_user->fetch_assoc();
        $usuario_id = $user['id'];

        $sql_carro = "SELECT carrito_id FROM usuario_carrito WHERE usuario_id = $usuario_id";
        $result_carro = $conn->query($sql_carro);
        if ($result_carro->num_rows > 0) {
            $carro = $result_carro->fetch_assoc();
            $carrito_id = $carro['carrito_id'];

            $sql_delete = "DELETE FROM carritos_productos WHERE carrito_id = $carrito_id AND producto_id = $producto_id";
            if ($conn->query($sql_delete) === TRUE) {
                header("Location:../php/carrito.php");
                exit();
            } else {
                echo "Error al eliminar el producto: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>
