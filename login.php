<?php
include "connect.php";

session_start(); // Start the session

if (isset($_SESSION['username'])) { // Check if the user is already authenticated
    header("Location: index.php"); // If authenticated, redirect to the home page or dashboard
    exit; // End script execution
}

// Prepare the PDO query
$stmt = $db->prepare("SELECT * FROM site_settings WHERE id = :id");
$stmt->execute(['id' => 1]); // Execute with parameter
$siteSettings = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$siteSettings) {
    die('Error fetching site settings.');
}

// Check if there is a message in the URL
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

// Get error messages from the session
$errorMessages = isset($_SESSION['ERRMSG_ARR']) ? $_SESSION['ERRMSG_ARR'] : [];
unset($_SESSION['ERRMSG_ARR']);

// Prioritize the URL message over session error messages
if (!empty($message)) {
    $errorMessages = [$message];
}
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
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"> <!-- Volviendo a favicon.ico -->
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Merienda+One|Open+Sans:300,400,600" rel="stylesheet">
    <link href="assets/css/login.css" rel='stylesheet' type='text/css' media="all">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>


<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Inicia Sesión</h2>
            <?php if (!empty($errorMessages)): ?>
                <div class="error-message">
                    <?php foreach ($errorMessages as $message): ?>
                        <p><?php echo htmlspecialchars($message); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="login2.php" method="post">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Usuario" required="">
                </div>
                <div class="input-group">
                    <input type="password" name="pass" placeholder="Contraseña" required="">
                </div>
                <div class="input-group">
                    <button type="submit">Ingresa</button>
                </div>
            </form>
        </div>
        <div class="copy">
            <p>&copy;2024 <?php echo htmlspecialchars($siteSettings['site_name']); ?></p>
        </div>
    </div>
</body>

</html>