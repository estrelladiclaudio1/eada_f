<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html");
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'eada');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Validar y obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $rol = isset($_POST['rol']) ? $_POST['rol'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($nombre && $apellido && $email && $rol && $password) {
        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellido, email, rol, contraseña) VALUES ('$nombre', '$apellido', '$email', '$rol', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Integrante agregado con éxito.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Integrantes</title>
</head>
<body>
    <h1>Agregar Integrantes</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
        <option value="Programador">Programador</option>
        <option value="Cliente">Cliente</option>
        <option value="Admin">Admin</option>
    </select>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>
