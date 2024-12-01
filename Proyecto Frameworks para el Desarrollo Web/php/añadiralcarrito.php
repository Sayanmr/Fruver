<?php
session_start();


if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
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


        $sql_check_product = "SELECT * FROM carritos_productos WHERE carrito_id = $carrito_id AND producto_id = $producto_id";
        $result_check_product = $conn->query($sql_check_product);

        if ($result_check_product->num_rows == 0) {

            $sql_add_product = "INSERT INTO carritos_productos (carrito_id, producto_id) VALUES ($carrito_id, $producto_id)";
            if ($conn->query($sql_add_product) === TRUE) {
                echo "<h1>¡Producto añadido al carrito con éxito!</h1>";
                echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver a la tienda</a></p>";
                echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
            } else {
                echo "Error al añadir el producto al carrito: " . $conn->error;
            }
        } else {
            echo "<h1>¡Este producto ya está en tu carrito!</h1>";
            echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver a la tienda</a></p>";
            echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
        }
    } else {

        $sql_create_carrito = "INSERT INTO carro (fecha_creado) VALUES (NOW())";
        if ($conn->query($sql_create_carrito) === TRUE) {
            $carrito_id = $conn->insert_id;

            $sql_relacionar_carrito = "INSERT INTO usuario_carrito (usuario_id, carrito_id) VALUES ($usuario_id, $carrito_id)";
            $conn->query($sql_relacionar_carrito);

            $sql_add_product = "INSERT INTO carritos_productos (carrito_id, producto_id) VALUES ($carrito_id, $producto_id)";
            if ($conn->query($sql_add_product) === TRUE) {
                echo "<h1>¡Producto añadido al carrito con éxito!</h1>";
                echo "<p><a href='" . $_SERVER['HTTP_REFERER'] . "'>Volver a la tienda</a></p>";
                echo "<img class='logo-img' src='../img/logo2.png' alt='logo'>";
            } else {
                echo "Error al añadir el producto al carrito: " . $conn->error;
            }
        } else {
            die("Error al crear el carrito: " . $conn->error);
        }
    }
} else {
    echo "Usuario no encontrado.";
}

$conn->close();
?>
<link rel="stylesheet" href="../css/pedir.css">