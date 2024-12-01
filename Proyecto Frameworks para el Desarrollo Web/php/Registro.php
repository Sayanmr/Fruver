<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>
    <link rel="stylesheet" href="../css/Registro.css">
</head>
<body>
<form method="post">
<h2>Registro</h2>
<?php
    include("db.php");
    include("validarregistro.php");
?>
<input required name="nombre" type="text" class="input" placeholder="Nombre" >
<input required name="apellido" type="text" class="input" placeholder="Apellido">
<input required name="correo" type="email" class="input" placeholder="Correo">
<input required name="contraseña" type="password" class="input" placeholder="Contraseña">
<input required name="fecha" type="date" class="input" placeholder="Fecha de Nacimiento">
<form method="post">
<input type="submit" class="btn" value="Registrarse" name="btnregistrar">
</form>
</form>
</body>
</html>