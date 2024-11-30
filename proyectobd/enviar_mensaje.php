<?php
include('conexion.php');

// Comprobar si se recibió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoMensaje = $_POST['codigoMensaje'];
    $asuntoMensaje = $_POST['asunto_mensaje'];
    $fechaMensaje = $_POST['fecha_mensaje'];
    $destinatarioMensaje = $_POST['destinatario_mensaje'];
    $remitenteMensaje = $_POST['remitente_mensaje'];
    $idUsuario = $_POST['id_usuario'];
    $codigoReserva = $_POST['codigo_reserva'];

    // Insertar mensaje en la base de datos
    $sql = "INSERT INTO mensajes (codigo_mensaje, asunto, fecha, destinatario, remitente, id_usuario, codigo_reserva) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issssii", $codigoMensaje, $asuntoMensaje, $fechaMensaje, $destinatarioMensaje, $remitenteMensaje, $idUsuario, $codigoReserva);
        if ($stmt->execute()) {
            echo "Mensaje enviado exitosamente.";
        } else {
            echo "Error al enviar el mensaje: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
