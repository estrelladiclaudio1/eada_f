<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Asegurar entrada limpia y evitar inyección SQL
    $titulo = $conn->real_escape_string(trim($_POST['titulo']));
    $fecha_asignacion = $conn->real_escape_string(trim($_POST['fecha_asignacion']));
    $fecha_finalizacion = $conn->real_escape_string(trim($_POST['fecha_finalizacion']));
    $descripcion = $conn->real_escape_string(trim($_POST['descripcion']));
    $descripcion_pedido = $conn->real_escape_string(trim($_POST['descripcion_pedido']));
    $descripcion_archivos = $conn->real_escape_string(trim($_POST['descripcion_archivos']));
    $paleta_colores = $conn->real_escape_string(trim($_POST['paleta_colores']));
    $esquema_diseño = $conn->real_escape_string(trim($_POST['esquema_diseño']));
    $prioridad = $conn->real_escape_string(trim($_POST['prioridad']));
    $comentarios_adicionales = $conn->real_escape_string(trim($_POST['comentarios_adicionales']));

    // Consulta SQL sin el campo id_cliente
    $sql = "INSERT INTO tickets (titulo, fecha_asignacion, fecha_finalizacion, descripcion, descripcion_pedido, descripcion_archivos, paleta_colores, esquema_diseño, prioridad, comentarios_adicionales)
            VALUES ('$titulo', '$fecha_asignacion', '$fecha_finalizacion', '$descripcion', '$descripcion_pedido', '$descripcion_archivos', '$paleta_colores', '$esquema_diseño', '$prioridad', '$comentarios_adicionales')";

    if ($conn->query($sql) === TRUE) {
        echo "Ticket guardado exitosamente.";
        header("Location: principal.php");
        exit();
    } else {
        echo "Error al guardar el ticket: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>