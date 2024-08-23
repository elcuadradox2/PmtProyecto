<?php
include "connect.php";

session_start(); // Inicia la sesión

if (isset($_SESSION['username'])) { // Comprueba si el usuario ya está autenticado
    header("Location: index.php"); // Si ya está autenticado, redirige al usuario a la página de inicio o dashboard
    exit; // Termina la ejecución del script
}

// Preparar la consulta PDO
$stmt = $db->prepare("SELECT * FROM site_settings WHERE id = :id");
$stmt->execute(['id' => 1]); // Ejecutar con parámetro
$siteSettings = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$siteSettings) {
    die('Error al obtener la configuración del sitio.');
}

$errorMessages = isset($_SESSION['ERRMSG_ARR']) ? $_SESSION['ERRMSG_ARR'] : [];
unset($_SESSION['ERRMSG_ARR']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title><?php echo htmlspecialchars($siteSettings['site_name']); ?></title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <!-- Meta tags -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' media="all">
    <!--//style sheet end here-->
    <link href="http://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
</head>

<body>
    <div class="swm-right-w3ls">
        <form action="login2.php" method="post">
            <div class="header-side"></div>
            <div class="main">
                <div class="icon-head">
                    <h2>Inicia Sesión</h2>
                </div>
                <?php if (!empty($errorMessages)): ?>
                    <div class="error-message">
                        <?php foreach ($errorMessages as $message): ?>
                            <p><?php echo htmlspecialchars($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="form-left-w3l">
                    <input type="text" name="username" placeholder="Usuario" required="">
                    <div class="clear"></div>
                </div>
                <div class="form-right-w3ls">
                    <input type="password" name="pass" placeholder="Contraseña" required="">
                    <div class="clear"></div>
                </div>
                <div class="btnn">
                    <button type="submit">Ingresa</button>
                    <br>
                </div>
            </div>
        </form>
    </div>
    <div class="copy">
        <p>&copy;2024 <?php echo htmlspecialchars($siteSettings['site_name']); ?></p>
    </div>
</body>

</html>