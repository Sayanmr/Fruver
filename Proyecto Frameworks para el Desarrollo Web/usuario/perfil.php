<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Reemplaza con tu usuario de MySQL
$password = ""; // Reemplaza con tu contraseña de MySQL
$dbname = "fruver_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el correo del usuario desde la sesión
session_start();
$varsesion = $_SESSION['correo'];
if ($varsesion == null || $varsesion == '') {
    header("location:../php/login.php");
    die();
}

// Obtener los datos del usuario de la base de datos
$sql = "SELECT nombre, apellido, correo, contraseña, fecha_nacimiento FROM usuario WHERE correo = '$varsesion'";
$result = $conn->query($sql);

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $correo = $row['correo'];
    $contraseña = $row['contraseña'];
    $fecha_nacimiento = $row['fecha_nacimiento'];
} else {
    echo "No se encontró el usuario.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruver - Perfil de Usuario</title>
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="icon" href="../img/logo2.png">
</head>
<body>
    <nav class="navegador">
        <ul class="lista-n">
            <li class="itemlista-n">
                <img class="logo-img" src="../img/logo2.png" alt="logo">
            </li>
            <li class="itemlista-n">
                <a href="../index.html" class="link-n">Inicio</a>
                <a href="../php/carrito.php" class="carrito1"><img class="img-c" src="../img/carrito.png" alt="carrito"></a>
            </li>
        </ul>
    </nav>
    <main>
        <section class="perfil">
            <h2>Perfil de Usuario</h2>
            <div class="info">
            <p><strong>Nombre:</strong> <span id="nombre"><?php echo $nombre; ?></span></p>
            <p><strong>Apellido:</strong> <span id="apellido"><?php echo $apellido; ?></span></p>
            <p><strong>Email:</strong> <span id="email"><?php echo $correo; ?></span></p>
            <p><strong>Contraseña:</strong> <span id="contraseña"><?php echo $contraseña; ?></span></p>
            <p><strong>Fecha de Nacimiento:</strong> <span id="fecha-nacimiento"><?php echo $fecha_nacimiento; ?></span></p>
            </div>
        </section>
    </main>

    <div id="modal-editar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="actualizarperfil.php" id="editar-form">
                <label for="nuevo-nombre">Nombre:</label>
                <input type="text" id="nuevo-nombre">
                <label for="nuevo-apellido">Apellido:</label>
                <input type="text" id="nuevo-apellido">
                <label for="nuevo-email">Email:</label>
                <input type="email" id="nuevo-email">
                <label for="nueva-contraseña">Contraseña:</label>
                <input type="password" id="nueva-contraseña">
                <label for="nueva-fecha-nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="nueva-fecha-nacimiento">
                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
    <a class="logout" href="cerrarseccion.php">Cerrar Seccion</a>
</body>
</html>