<?php
$servername = "localhost";
$username = "root";
$password = "Emir**1904";
$dbname = "boda_db";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8mb4");


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$nombre = trim($_POST['nombre']); 

$sql_check = "SELECT * FROM confirmaciones WHERE nombre = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Error: Ya has confirmado tu asistencia.";
} else {
    $sql_insert = "INSERT INTO confirmaciones (nombre, asistencia) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $asistencia = $_POST['asistencia']; // "Sí" o "No"
    $stmt->bind_param("ss", $nombre, $asistencia);

    if ($stmt->execute()) {
        echo "Confirmación registrada correctamente.";
    } else {
        echo "Error al registrar: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
