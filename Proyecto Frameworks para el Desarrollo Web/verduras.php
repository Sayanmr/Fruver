<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruver_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, precio FROM productos WHERE tipo = 'Vegetal'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verduras</title>
    <link rel="stylesheet" href="./css/productos.css">
    <link rel="icon" href="./img/logo2.png">
</head>
<body>
    <nav class="navegador">
        <ul class="lista-n">
            <li class="itemlista-n">
                <img class="logo-img" src="./img/logo2.png" alt="logo">
            </li>
            <li class="itemlista-n">
                <a href="index.html" class="link-n">Inicio</a>
                <a href="./usuario/perfil.php" class="link-n">Perfil</a>
                <a href="/php/carrito.php" class="carrito"><img class="img-c" src="./img/carrito.png" alt="carrito"></a>
            </li>
        </ul>
    </nav>
    <div class="titulo">
        <h1 class="titulo-h1">Verduras</h1>
    </div>
    <section id="products-list" class="products-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                echo '<img src="./img/verduras/' . strtolower($row['nombre']) . '.png" alt="' . $row['nombre'] . '" class="product-img">';
                echo '<h2 class="product-name">' . $row['nombre'] . '</h2>';
                echo '<p class="product-price">Precio: ' . number_format($row['precio'], 2) . '</p>';
                echo '<form action="./php/añadiralcarrito.php" method="post">';
                echo '<input type="hidden" name="producto_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="botonsito">Añadir al Carrito</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </section>
</body>
</html>
