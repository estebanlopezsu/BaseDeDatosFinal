<?php
// procesar_login.php

// Verifica que el formulario fue enviado por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe los datos del formulario
    $nombre = trim($_POST['nombre']);
    $cedula = trim($_POST['cedula']);

    // Conexión a la base de datos
    $host = 'localhost'; // Cambiar según tu configuración
    $usuario = 'root'; // Cambiar según tu configuración
    $contraseña = ''; // Cambiar según tu configuración
    $base_datos = 'gestion_residencial'; // Cambiar según tu base de datos

    $conn = new mysqli($host, $usuario, $contraseña, $base_datos);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
    }

    // Consulta para verificar al usuario
    $sql = "SELECT rol FROM usuarios WHERE nombre = ? AND cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre, $cedula);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica si existe el usuario
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $rol = $fila['rol'];

        // Redirige según el rol
        if ($rol === 'administrador') {
            header("Location: administrador.php");
            exit();
        } elseif ($rol === 'residente') {
            header("Location: residente.php");
            exit();
        } else {
            echo "Rol no válido.";
        }
    } else {
        echo "Usuario no encontrado o datos incorrectos.";
    }

    // Cierra la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>
