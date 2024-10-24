<?php
// Configuración de conexión a la base de datos
$host = "localhost";
$usuario = "root";  // Cambia según tu configuración
$password = "";     // Cambia según tu configuración
$base_datos = "formulario_registro";

// Crear la conexión
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $genero = $_POST['genero'] ?? null;
    $departamento = $_POST['departamento'] ?? null;
    $ciudad = $_POST['ciudad'] ?? null;
    $comentarios = $_POST['comentarios'] ?? null;
    $acepto_terminos = isset($_POST['terminos']) ? 1 : 0;

    // Preparar la consulta SQL utilizando declaraciones preparadas
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_completo, email, telefono, genero, departamento, ciudad, comentarios, acepto_terminos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $nombre, $email, $telefono, $genero, $departamento, $ciudad, $comentarios, $acepto_terminos);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        echo "Registro guardado correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
