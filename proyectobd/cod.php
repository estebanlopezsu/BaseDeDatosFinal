<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "gestion_residencial";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Procesamiento de formularios
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    switch ($action) {
        case "registro_usuario":
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];
            $direccion = $_POST["direccion"];

            $stmt = $conn->prepare("INSERT INTO usuarios (id, nombre, correo, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$id, $nombre, $correo, $telefono, $direccion]);
            echo "Usuario registrado con éxito.";
            break;

        case "registro_inmueble":
            $codigoInmueble = $_POST["codigoInmueble"];
            $descripcionInmueble = $_POST["descripcionInmueble"];
            $estado = $_POST["estado"];
            $codigoUsuario = $_POST["codigoUsuario"];

            $stmt = $conn->prepare("INSERT INTO inmuebles (codigo, descripcion, estado, codigo_usuario) VALUES (?, ?, ?, ?)");
            $stmt->execute([$codigoInmueble, $descripcionInmueble, $estado, $codigoUsuario]);
            echo "Inmueble registrado con éxito.";
            break;

        case "realizar_pago":
            $codigoUsuarioPago = $_POST["codigoUsuarioPago"];
            $monto = $_POST["monto"];
            $fecha = $_POST["fecha"];
            $estadoPago = $_POST["estadoPago"];

            $stmt = $conn->prepare("INSERT INTO pagos (codigo_usuario, monto, fecha, estado) VALUES (?, ?, ?, ?)");
            $stmt->execute([$codigoUsuarioPago, $monto, $fecha, $estadoPago]);
            echo "Pago registrado con éxito.";
            break;

        case "reserva":
            $codigoReserva = $_POST["codigoReserva"];
            $fecha_reserva = $_POST["fecha_reserva"];
            $disponibleReserva = $_POST["disponibleReserva"];
            $codigoUsuarioReserva = $_POST["codigoUsuarioReserva"];

            $stmt = $conn->prepare("INSERT INTO reservas (codigo, fecha, disponibilidad, codigo_usuario) VALUES (?, ?, ?, ?)");
            $stmt->execute([$codigoReserva, $fecha_reserva, $disponibleReserva, $codigoUsuarioReserva]);
            echo "Reserva registrada con éxito.";
            break;

        case "enviar_mensaje":
            $codigoMensaje = $_POST["codigoMensaje"];
            $asunto_mensaje = $_POST["asunto_mensaje"];
            $fecha_mensaje = $_POST["fecha_mensaje"];
            $destinatario_mensaje = $_POST["destinatario_mensaje"];
            $remitente_mensaje = $_POST["remitente_mensaje"];
            $id_usuario = $_POST["id_usuario"];
            $codigo_reserva = $_POST["codigo_reserva"];

            $stmt = $conn->prepare("INSERT INTO mensajes (codigo, asunto, fecha, destinatario, remitente, id_usuario, codigo_reserva) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$codigoMensaje, $asunto_mensaje, $fecha_mensaje, $destinatario_mensaje, $remitente_mensaje, $id_usuario, $codigo_reserva]);
            echo "Mensaje enviado con éxito.";
            break;

        case "crear_evento":
            $codigoEvento = $_POST["codigoEvento"];
            $tipo_evento = $_POST["tipo_evento"];
            $descripcion_evento = $_POST["descripcion_evento"];
            $fecha_evento = $_POST["fecha_evento"];
            $recordatorio_evento = $_POST["recordatorio_evento"];
            $id_usuario = $_POST["id_usuario"];

            $stmt = $conn->prepare("INSERT INTO eventos (codigo, tipo, descripcion, fecha, recordatorio, id_usuario) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$codigoEvento, $tipo_evento, $descripcion_evento, $fecha_evento, $recordatorio_evento, $id_usuario]);
            echo "Evento creado con éxito.";
            break;

        // Agrega casos para las demás funcionalidades...

        default:
            echo "Acción no reconocida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Residencial</title>
</head>
<body>
    <h1>Gestión Residencial</h1>
    <p>Utiliza los formularios de la interfaz HTML para enviar datos a este archivo PHP.</p>
</body>
</html>
