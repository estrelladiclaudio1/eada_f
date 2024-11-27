<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar que los campos están definidos en el POST
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $nombre = trim($_POST['username']); 
        $password = trim($_POST['password']); 

        $query = "SELECT * FROM usuarios WHERE Nombre = '$nombre'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Comparar contraseñas
            if ($password === $user['Contraseña']) {
                // Login exitoso
                $_SESSION['nombre_usuario'] = $user['Nombre'];  
                $_SESSION['rol_usuario'] = $user['Rol']; 

                // Redirigir según el rol
                if ($user['Rol'] == 'Admin') {
                    header("Location: princi_admin.php");
                } elseif ($user['Rol'] == 'Programador') {
                    header("Location: princi_progra.php");
                } else {
                    header("Location: principal.php"); 
                }
                exit();
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Usuario no encontrado";
        }
    } 
}
?>