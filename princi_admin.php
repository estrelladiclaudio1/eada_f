<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

// Contenido de la página principal
echo "<h1 class='titulo-bienvenida'>Bienvenido/a, " . htmlspecialchars($_SESSION['nombre_usuario']) . " (Administrador)</h1>";

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'eada');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="admin.css"> <!-- Archivo de estilos -->
</head>
<body class="fondo-pagina">
    <h3>Usuarios registrados</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Teléfono</th>
            <th>Fecha de Registro</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        
        <?php
        // Mostrar los usuarios en una tabla
        if ($result->num_rows > 0) {
            while ($usuario = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($usuario['Id_usuario']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Apellido']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Email']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Contraseña']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Telefono']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Fecha_Registro']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['Rol']) . "</td>";
                // Enlace para modificar el usuario, pasando el id_usuario como parámetro
                echo "<td><a href='modificar_integrantes.php?id_usuario=" . $usuario['Id_usuario'] . "'>Modificar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No se encontraron usuarios.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br>
    <form method="post" action="" class="formulario-botones">
        <button class="boton-animado" name="agregar" type="submit" formaction="agregar_integrantes.php">Agregar integrantes</button>
    </form>
    <h4>Ticekts</h3>
</body>
</html>