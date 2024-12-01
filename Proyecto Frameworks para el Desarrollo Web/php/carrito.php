<link rel="stylesheet" href="../css/carrito.css?v=1.0">
<nav class="navegador">
        <ul class="lista-n">
            <li class="itemlista-n">
                <img class="logo-img" src="../img/logo2.png" alt="logo">
            </li>
            <li class="itemlista-n">
                <a href="../index.html" class="link-n">Inicio</a>
                <a href="../admin/adminperfil.php" class="link-n">Perfil</a>
            </li>
        </ul>
    </nav>
<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
    header("Location:../php/login.php");
    exit();
}

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['correo'];

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruver_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el id del usuario
$sql_user = "SELECT id FROM usuario WHERE correo = '$correo'";
$result_user = $conn->query($sql_user);
if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
    $usuario_id = $user['id'];

    // Buscar el carrito del usuario
    $sql_carro = "SELECT carrito_id FROM usuario_carrito WHERE usuario_id = $usuario_id";
    $result_carro = $conn->query($sql_carro);

    if ($result_carro->num_rows > 0) {
        $carro = $result_carro->fetch_assoc();
        $carrito_id = $carro['carrito_id'];

        // Obtener los productos en el carrito
        $sql_products = "SELECT cp.producto_id, p.nombre, p.precio FROM productos p 
                         JOIN carritos_productos cp ON p.id = cp.producto_id 
                         WHERE cp.carrito_id = $carrito_id";
        $result_products = $conn->query($sql_products);

        echo '<div class="container">';

        if ($result_products->num_rows > 0) {
            echo "<h1 class='title'>Productos en tu carrito</h1>";
            echo "<ul class='product-list'>";
            while ($row = $result_products->fetch_assoc()) {
                echo "<li class='product-item'>";
                echo "<span class='product-name'>" . $row['nombre'] . "</span>";
                echo "<span class='product-price'>$" . number_format($row['precio'], 2) . "</span>";

                // Botón de eliminar
                echo "<form action='../admin/eliminaradmin.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='producto_id' value='" . $row['producto_id'] . "'>";
                echo "<button type='submit' class='delete-btn'>Eliminar</button>";
                echo "</form>";
                echo "</li>";
            }
            
            echo "</ul>";
        } else {
            echo "<p class='no-products'>No tienes productos en tu carrito</p>";
        }

        echo '</div>';

    } else {
        echo "<p class='no-cart'>No tienes un carrito asociado</p>";
    }
} else {
    echo "<p class='error'>Usuario no encontrado.</p>";
}

$conn->close();
?>
<form class="contenedor-comprar" action="vaciar_carrito.php" method="POST">
    <button type="submit" name="comprar_carrito" class="boton-comprar">Comprar Carrito</button>
</form>
