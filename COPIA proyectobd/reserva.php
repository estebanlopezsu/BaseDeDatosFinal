<?php
include('conexion.php');

// Comprobar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoReserva = $_POST['codigoReserva'];
    $fechaReserva = $_POST['fecha_reserva'];
    $disponibilidadReserva = $_POST['disponibleReserva'];
    $codigoUsuarioReserva = $_POST['codigoUsuarioReserva'];

    // Insertar reserva en la base de datos
    $sql = "INSERT INTO reservas (codigo_reserva, fecha_reserva, disponibilidad, codigo_usuario) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issi", $codigoReserva, $fechaReserva, $disponibilidadReserva, $codigoUsuarioReserva);
        if ($stmt->execute()) {
            echo "Reserva realizada exitosamente.";
        } else {
            echo "Error al registrar la reserva: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
