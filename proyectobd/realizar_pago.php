<?php
include('conexion.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoUsuarioPago = $_POST['codigoUsuarioPago'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];
    $estadoPago = $_POST['estadoPago'];


    $sql = "INSERT INTO pagos (codigo_usuario, monto, fecha, estado) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iiss", $codigoUsuarioPago, $monto, $fecha, $estadoPago);
        if ($stmt->execute()) {
            echo "Pago realizado exitosamente.";
        } else {
            echo "Error al registrar el pago: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }


    $conn->close();
}
?>
