<?php
include('connect.php');

// Recibir datos del formulario
$a = $_POST['user_id'];
$b = $_POST['name'];
$c = $_POST['username'];
$d = $_POST['pass'];  // Asumiendo que se recibe la contraseña en texto plano
$e = $_POST['chapa_agente'];
$f = $_POST['position'];

// Validación básica
if(empty($b) || empty($c) || empty($d)) {
    header("location:add-user.php?error=empty_fields");
    exit;
}

// Validar contraseña (opcional)
// Implementa tu lógica de validación aquí

// Hash de la contraseña
$hashed_password = password_hash($d, PASSWORD_DEFAULT);

// Query para insertar datos
$sql = "INSERT INTO user (user_id, name, username, pass, chapa_agente, position) VALUES (:a, :b, :c, :d, :e, :f)";
$q = $db->prepare($sql);

// Ejecutar la consulta
if ($q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $hashed_password, ':e' => $e, ':f' => $f))) {
    header("location:add-user.php?success=true");
    exit;
} else {
    header("location:add-user.php?error=insert_failed");
    exit;
}
?>
