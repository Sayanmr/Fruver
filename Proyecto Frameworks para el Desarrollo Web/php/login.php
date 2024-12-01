<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css?v=1.0">
</head>
<body>
    <div class="content">
        <h1 id="registro">Inicia Seccion</h1>

        <!-- Formulario de registro -->
        <form action="validarlogin.php" id="formulario" method="POST">
            <div class="form-control" id="first-name">
                <label for="correo">Digite su Correo:</label>
                <input required name="correo" type="text" id="correo" placeholder="* Digite su correo"/>
            </div>

            <div class="form-control">
                <label for="contraseña">Digite su Contraseña:</label>
                <input required name="contraseña" type="password" id="contraseña" placeholder="* Digite su contraseña"/>
            </div>

            <input id="btnregistrar" class="submitbtn" type="submit" value="Ingresar">
        </form>
        <div class="form-control">
                <a href="Registro.php">Registrarse</a>
            </div>
    </div>
</body>
</html>