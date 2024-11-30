<?php
include('conexion.php');

// Comprobar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoPermiso = $_POST['codigo_permiso'];
    $descripcionPermiso = $_POST['descripcion_permiso'];

    // Insertar permiso en la base de datos
    $sql = "INSERT INTO permisos (codigo_permiso, descripcion) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("is", $codigoPermiso, $descripcionPermiso);
        if ($stmt->execute()) {
            echo "Permiso registrado exitosamente.";
        } else {
            echo "Error al registrar el permiso: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
