<?php
session_start();

// Establecer el tiempo de inactividad en segundos (10 minutos = 600 segundos)
$inactive = 600;

// Comprobar si la variable de sesión 'timeout' está establecida
if (isset($_SESSION['timeout'])) {
    // Calcular el tiempo de inactividad
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        // Si el tiempo de inactividad es mayor que el permitido, destruir la sesión
        session_unset();
        session_destroy();
        header("Location: login.php?message=Tu sesión ha expirado. Por favor, inicia sesión de nuevo.");
        exit();
    }
}

// Actualizar el tiempo de la última actividad
$_SESSION['timeout'] = time();
?>