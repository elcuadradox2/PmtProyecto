<?php
// Habilitar informes de errores
ini_set('display_errors', 0); // Deshabilitar la visualización de errores en producción
error_reporting(E_ALL); // Reportar todos los errores para fines de registro

$usuario = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') ?: "";
$servidor = getenv('DB_HOST') ?: "localhost";
$basededatos = getenv('DB_NAME') ?: "tos";

try {
    // Crear una conexión utilizando mysqli
    $conn = new mysqli($servidor, $usuario, $password, $basededatos);

    // Verificar la conexión
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Configurar la conexión para usar UTF-8
    if (!$conn->set_charset("utf8mb4")) {
        throw new Exception("Error setting charset: " . $conn->error);
    }

} catch (Exception $e) {
    // Registrar el error y mostrar un mensaje genérico
    error_log($e->getMessage());
    die("Upps! Error en la conexión. Por favor, inténtalo de nuevo más tarde.");
}

// Aquí iría el resto del código que interactúa con la base de datos utilizando $conn

?>
