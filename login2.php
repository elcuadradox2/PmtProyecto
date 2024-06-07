<?php
// Iniciar sesión
session_start();

// Array para almacenar errores de validación
$errmsg_arr = array();

// Bandera de error de validación
$errflag = false;

// Conectar al servidor MySQL
$link = mysqli_connect('localhost', 'root', '', 'tos');
if (!$link) {
    die('Failed to connect to server: ' . mysqli_connect_error());
}

// Función para limpiar y escapar las entradas para prevenir inyección SQL
function clean($link, $str) {
    $str = trim($str);
    if (function_exists('mysqli_real_escape_string')) {
        $str = mysqli_real_escape_string($link, $str);
    }
    return $str;
}

// Sanitizar las entradas POST
$login = clean($link, $_POST['username']);
$password = clean($link, $_POST['pass']);

// Validaciones de entrada
if ($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

// Si hay errores de validación, redirigir de nuevo al formulario de inicio de sesión
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

// Consulta para obtener la contraseña hasheada del usuario
$qry = "SELECT id, name, position, username, pass FROM user WHERE username=?";
$stmt = mysqli_prepare($link, $qry);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Verificar si la consulta se ejecutó correctamente
    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Encontró el usuario, obtener los resultados
        mysqli_stmt_bind_result($stmt, $id, $name, $position, $username, $hashed_password);
        mysqli_stmt_fetch($stmt);

        // Verificar si la contraseña coincide
        if (password_verify($password, $hashed_password)) {
            // Contraseña correcta, iniciar sesión
            session_regenerate_id();
            $_SESSION['SESS_MEMBER_ID'] = $id;
            $_SESSION['SESS_FIRST_NAME'] = $name;
            $_SESSION['SESS_LAST_NAME'] = $position;
            $_SESSION['SESS_PRO_PIC'] = $username;
            mysqli_stmt_close($stmt);
            session_write_close();
            header("location: index.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("location: login.php");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("location: login.php");
        exit();
    }
} else {
    die("Query failed");
}
?>
