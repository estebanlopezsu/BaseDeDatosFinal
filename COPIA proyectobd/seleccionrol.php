<?php
// procesar_rol.php

// Verifica que el formulario fue enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe los datos enviados desde el formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $cedula = htmlspecialchars($_POST['cedula']);
    $rol = htmlspecialchars($_POST['rol']);

    // Valida que los campos no estén vacíos
    if (empty($nombre) || empty($cedula) || empty($rol)) {
        echo "Error: Todos los campos son obligatorios.";
        exit;
    }

    // Redirecciona al dashboard correspondiente según el rol seleccionado
    if ($rol === 'administrador') {
        header("Location: administrador_dashboard.php?nombre=$nombre&cedula=$cedula");
        exit;
    } elseif ($rol === 'residente') {
        header("Location: residente_dashboard.php?nombre=$nombre&cedula=$cedula");
        exit;
    } else {
        echo "Error: Rol no válido.";
        exit;
    }
} else {
    // Si el acceso no fue por el método POST, muestra un mensaje de error
    echo "Error: Acceso no autorizado.";
    exit;
}