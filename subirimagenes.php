<?php 
include 'session_timeout.php';
include "sidebar.php"; ?>


<?php
include('configbd.php');

// Ajustar la zona horaria a tu región
date_default_timezone_set('America/Mexico_City'); // Cambia esto a tu zona horaria

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se han enviado archivos
if (isset($_FILES['imagenes'])) {
    $totalArchivos = count($_FILES['imagenes']['name']);
    
    // Limitar el número máximo de archivos a 10
    if ($totalArchivos > 10) {
        echo 'No se pueden subir más de 10 archivos a la vez.';
        exit;
    }
    
    // Directorio donde se guardarán las imágenes
    $directorio = 'fotosboletas/';
    
    // Verificar si el directorio existe, si no, crearlo
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }
    
    // Obtener el nombre del usuario conectado (puedes obtenerlo de tu sistema de autenticación)
    $nombreUsuario = isset($_SESSION['SESS_FIRST_NAME']) ? htmlspecialchars($_SESSION['SESS_FIRST_NAME']) : '';
    
    // Validar el nombre de usuario
    if (empty($nombreUsuario)) {
        echo 'Nombre de usuario no válido.';
        exit;
    }
    
    for ($i = 0; $i < $totalArchivos; $i++) {
        $nombreArchivo = $_FILES['imagenes']['name'][$i];
        $tipoArchivo = $_FILES['imagenes']['type'][$i];
        $tamanoArchivo = $_FILES['imagenes']['size'][$i];
        $tempArchivo = $_FILES['imagenes']['tmp_name'][$i];
        
        // Validar el tipo de archivo
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        if (!in_array(strtolower($extensionArchivo), $extensionesPermitidas)) {
            echo 'El archivo ' . htmlspecialchars($nombreArchivo) . ' no es una imagen válida.<br>';
            continue;
        }
        
        // Obtener la fecha y hora actual del servidor
        $fechaHoraActual = date('Y-m-d_H-i-s');
        
        // Generar el nuevo nombre de archivo con la fecha, hora y nombre de usuario
        $nuevoNombreArchivo = $fechaHoraActual . '_' . $nombreUsuario . '_' . $i . '.' . $extensionArchivo;
        
        // Verificar el tamaño del archivo
        if ($tamanoArchivo > 10 * 1024 * 1024) {
            echo 'El tamaño del archivo ' . htmlspecialchars($nombreArchivo) . ' excede el límite permitido de 10 megabytes.<br>';
            continue;
        }
        
        // Mover el archivo al directorio especificado con el nuevo nombre de archivo
        if (move_uploaded_file($tempArchivo, $directorio . $nuevoNombreArchivo)) {
            echo 'La imagen ' . htmlspecialchars($nombreArchivo) . ' se ha subido correctamente.<br>';
        } else {
            echo 'Error al subir la imagen ' . htmlspecialchars($nombreArchivo) . '.<br>';
        }
    }
}
?>

<!-- Tarjeta HTML para el formulario de subir la imagen -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="header">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Subir imágenes</h1>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="imagenes">Seleccionar imágenes (MÁXIMO 10 FOTOS):</label>
                                    <input type="file" name="imagenes[]" accept="image/*" class="form-control-file" multiple>
                                </div>
                                <input type="submit" value="Subir imágenes" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$user = isset($_SESSION['SESS_MEMBER_ID']) ? $_SESSION['SESS_MEMBER_ID'] : '';
if (!empty($user)) {
    $result = $db->prepare("SELECT id, username, name FROM user WHERE id = :userId");
    $result->bindParam(':userId', $user, PDO::PARAM_INT);
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // código dentro del bucle while
    }
}
?>
<?php include "footer.php"; ?>