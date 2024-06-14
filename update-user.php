<?php
session_start();
include('connect.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['SESS_MEMBER_ID'])) {
    header("location: login.php");
    exit();
}

// Obtener los datos del formulario
$user_id = $_POST['user_id'] ?? null;
$new_password = $_POST['new_password'] ?? null;

// Validar los datos
if (is_null($user_id) || is_null($new_password)) {
    // Redirigir o mostrar mensaje de error
    header("location:user.php?error=datos_invalidos");
    exit();
}

// Hash de la nueva contraseña
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Preparar la consulta para actualizar la contraseña
$sql = "UPDATE user SET pass = ? WHERE id = ?";
$stmt = $db->prepare($sql);

// Ejecutar la consulta
if ($stmt->execute([$hashed_password, $user_id])) {
    // Redirigir o mostrar mensaje de éxito
    header("location:user.php?success=true");
} else {
    // Redirigir o mostrar mensaje de error
    header("location:user.php?error=actualizacion_fallida");
}
?>