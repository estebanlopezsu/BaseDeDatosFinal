<?php

include('conexion.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoUsuarioEditar = $_POST['codigoUsuarioEditar'];
    $nombreUsuarioEditar = $_POST['nombreUsuarioEditar'];
    $emailUsuarioEditar = $_POST['emailUsuarioEditar'];
    $rolUsuarioEditar = $_POST['rolUsuarioEditar'];

    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE codigo = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $nombreUsuarioEditar, $emailUsuarioEditar, $rolUsuarioEditar, $codigoUsuarioEditar);
        if ($stmt->execute()) {
            echo "Usuario actualizado exitosamente.";
        } else {
            echo "Error al actualizar el usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
    
    $conn->close();
}
?>
