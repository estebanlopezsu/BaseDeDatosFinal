<?php
// registrar_usuario.php

// Verifica que el formulario fue enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe los datos enviados desde el formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $cedula = htmlspecialchars(trim($_POST['cedula']));
    $contraseña = htmlspecialchars(trim($_POST['contraseña']));

    // Valida que los campos no estén vacíos
    if (empty($nombre) || empty($cedula) || empty($contraseña)) {
        echo "Error: Todos los campos son obligatorios.";
        exit;
    }

    // Conexión a la base de datos
    $servidor = "localhost"; // Cambiar según la configuración
    $usuarioBD = "root"; // Cambiar según la configuración
    $contraseñaBD = ""; // Cambiar según la configuración
    $baseDeDatos = "gestión_residencial"; // Cambiar según el nombre de tu base de datos

    // Intentar conectar
    $conn = new mysqli($servidor, $usuarioBD, $contraseñaBD, $baseDeDatos);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Error al conectar con la base de datos: " . $conn->connect_error);
    }

    // Verifica si la cédula ya está registrada
    $queryVerificar = "SELECT * FROM usuarios WHERE cedula = ?";
    $stmtVerificar = $conn->prepare($queryVerificar);
    $stmtVerificar->bind_param("s", $cedula);
    $stmtVerificar->execute();
    $resultado = $stmtVerificar->get_result();

    if ($resultado->num_rows > 0) {
        echo "Error: La cédula ya está registrada.";
        $stmtVerificar->close();
        $conn->close();
        exit;
    }
    $stmtVerificar->close();

    // Inserta el nuevo usuario en la base de datos
    $queryInsertar = "INSERT INTO usuarios (nombre, cedula, contraseña) VALUES (?, ?, ?)";
    $stmtInsertar = $conn->prepare($queryInsertar);
    $stmtInsertar->bind_param("sss", $nombre, $cedula, password_hash($contraseña, PASSWORD_DEFAULT));

    if ($stmtInsertar->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
        echo "<br><a href='inicio_sesion.html'>Ir a la página de inicio de sesión</a>";
    } else {
        echo "Error al registrar el usuario: " . $stmtInsertar->error;
    }

    $stmtInsertar->close();
    $conn->close();
} else {
    // Si el acceso no fue por el método POST, muestra un mensaje de error
    echo "Error: Acceso no autorizado.";
    exit;
}
