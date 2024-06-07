<?php
// Verificar la solicitud y la sesión aquí si es necesario

// Incluir tu archivo de conexión
include 'connect.php';

// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta para eliminar el usuario
    $stmt = $db->prepare("DELETE FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // Éxito: redireccionar a la página de listado de usuarios
        header("location: view-users.php");
        exit();
    } else {
        // Error al ejecutar la consulta
        echo 'Error al eliminar el usuario. Por favor, inténtelo de nuevo.';
    }
} else {
    // ID de usuario no válido o no proporcionado
    echo 'ID de usuario no válido.';
}
?>
