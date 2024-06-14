<?php
include('connect.php');
session_start(); // Iniciar sesión para manejar mensajes de error/success con variables de sesión

// Recibir datos del formulario
$a = $_POST['user_id']; // Asegúrate de que este valor se maneje de forma segura
$b = trim($_POST['name']);
$c = trim($_POST['username']);
$d = $_POST['pass']; // Asumiendo que se recibe la contraseña en texto plano
$e = trim($_POST['chapa_agente']);
$f = trim($_POST['position']);

// Validación mejorada
if(empty($b) || empty($c) || empty($d) || strlen($d) < 8) {
    $_SESSION['error'] = 'Campos obligatorios vacíos o contraseña demasiado corta.';
    header("location:add-user.php");
    exit;
}

// Validar que el nombre de usuario no exista ya
$query = $db->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
$query->execute([':username' => $c]);
if($query->fetchColumn() > 0) {
    $_SESSION['error'] = 'El nombre de usuario ya existe.';
    header("location:add-user.php");
    exit;
}

// Hash de la contraseña
$hashed_password = password_hash($d, PASSWORD_DEFAULT);

// Query para insertar datos
$sql = "INSERT INTO user (user_id, name, username, pass, chapa_agente, position) VALUES (:a, :b, :c, :d, :e, :f)";
$q = $db->prepare($sql);

// Ejecutar la consulta
if ($q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $hashed_password, ':e' => $e, ':f' => $f))) {
    $_SESSION['success'] = 'Usuario agregado correctamente.';
    header("location:add-user.php");
    exit;
} else {
    $_SESSION['error'] = 'Error al insertar el usuario.';
    header("location:add-user.php");
    exit;
}
?>