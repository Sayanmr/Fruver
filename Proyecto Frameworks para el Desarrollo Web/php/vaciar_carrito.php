<link rel="stylesheet" href="../css/pedir.css">
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

        $sql_check_products = "SELECT * FROM carritos_productos WHERE carrito_id = $carrito_id";
        $result_check_products = $conn->query($sql_check_products);

        if ($result_check_products->num_rows > 0) {
            $sql_delete_products = "DELETE FROM carritos_productos WHERE carrito_id = $carrito_id";
            if ($conn->query($sql_delete_products) === TRUE) {
                echo "<h1>¡Carrito Comprado!</h1>";
                echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver</a></p>";
                echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
                exit();
            } else {
                echo "<h1>Error al comprar el carrito</h1>";
                echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver</a></p>";
                echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
            }
        } else {
            echo "<h1>No tienes productos en tu carrito</h1>";
            echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver</a></p>";
            echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
        }
    } else {
        echo "<h1>No tienes carrito asociado</h1>";
        echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver</a></p>";
        echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
    }
} else {
    echo "<h1>Usuario no encontrado</h1>";
    echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver</a></p>";
    echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
}

$conn->close();
?>

