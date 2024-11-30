<?php
include('conexion.php');

// Comprobar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoVisita = $_POST['codigo_visita'];
    $nombreVisita = $_POST['nombre_visita'];
    $fechaVisita = $_POST['fecha_visita'];
    $motivoVisita = $_POST['motivo_visita'];
    $codigoReporte = $_POST['codigo_reporte'];
    $codigoEvento = $_POST['codigo_evento'];
    $codigoReserva = $_POST['codigo_reserva'];
    $codigoInmueble = $_POST['codigo_inmueble'];

    // Insertar visita en la base de datos
    $sql = "INSERT INTO visitas (codigo_visita, nombre_visita, fecha_visita, motivo_visita, codigo_reporte, codigo_evento, codigo_reserva, codigo_inmueble)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issssiii", $codigoVisita, $nombreVisita, $fechaVisita, $motivoVisita, $codigoReporte, $codigoEvento, $codigoReserva, $codigoInmueble);
        if ($stmt->execute()) {
            echo "Visita registrada exitosamente.";
        } else {
            echo "Error al registrar la visita: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
