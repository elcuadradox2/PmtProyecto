<?php 
include('configbd.php');

$no_boleta = $_POST['no_boleta'];
$ubicacion_aviso_pago = $_POST['ubicacion_aviso_pago'];
$dpi_aviso_pago = $_POST['dpi_aviso_pago'];
$no_placas = $_POST['no_placas'];
$fecha_hora_aviso_pago = $_POST['fecha_hora_aviso_pago'];
$nombre_completo = $_POST['nombre_completo'];
$descripcion_aviso_pago = $_POST['descripcion_aviso_pago'];
$tipo_boleta = $_POST['tipo_boleta'];
$nombre_chapa_agente = $_POST['nombre_chapa_agente'];
$estado_pago = $_POST['estado_pago'];

// Verificando si existe el directorio
$dirLocal = "files_boletaavisopago";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir = opendir($dirLocal); // Abro el directorio

if (isset($_POST['submit']) && count($_FILES['fotos_aviso_pago']['name']) > 0) {
    // Validar que no se suban más de 10 fotos
    if (count($_FILES['fotos_aviso_pago']['name']) > 10) {
        // Redirigir con mensaje de error
        header("Location: avisopago.php?status=error&message=too_many_files");
        exit();
    }

    // Recorrer cada archivo subido
    foreach ($_FILES['fotos_aviso_pago']['name'] as $i => $name) {
        // strlen método de php pues devuelve la longitud de una cadena
        if (strlen($_FILES['fotos_aviso_pago']['name'][$i]) > 1) {
            $fileName = $_FILES['fotos_aviso_pago']['name'][$i];
            $sourceFoto = $_FILES['fotos_aviso_pago']['tmp_name'][$i];
            $tamanoFoto = $_FILES["fotos_aviso_pago"]['size'][$i];
            $restricciontamano = 10; // MB
            if ((($tamanoFoto / 1024) / 1024) <= $restricciontamano) {
                /** Renombrando cada foto que llega desde el formulario */
                $nuevoNombreFile = substr(md5(uniqid(rand())), 0, 15);
                $extension_foto = pathinfo($fileName, PATHINFO_EXTENSION);
                $nombreFoto = $nuevoNombreFile . '.' . $extension_foto;

                $resultadoFotos = $dirLocal . '/' . $nombreFoto;

                // Mover archivo a una ubicación permanente
                move_uploaded_file($sourceFoto, $resultadoFotos);

                // Insertar información del archivo en la base de datos
                $sql = "INSERT INTO fotos_aviso_pago (foto, placa_aviso_pago, fecha_aviso_pago) VALUES ('{$nombreFoto}', '{$no_placas}', '{$fecha_hora_aviso_pago}')";
                mysqli_query($conn, $sql);
            } else {
                echo '<p style="color:red">Existe una foto que supera el peso máximo de ' . $tamanoFoto . '</p>';
            }
        }
    }
    $sql = "INSERT INTO aviso_pago (no_boleta, ubicacion_aviso_pago, dpi_aviso_pago, no_placas, fecha_hora_aviso_pago, nombre_completo, descripcion_aviso_pago, tipo_boleta, nombre_chapa_agente, estado_pago) VALUES ('{$no_boleta}', '{$ubicacion_aviso_pago}', '{$dpi_aviso_pago}', '{$no_placas}', '{$fecha_hora_aviso_pago}', '{$nombre_completo}', '{$descripcion_aviso_pago}', '{$tipo_boleta}', '{$nombre_chapa_agente}', '{$estado_pago}')";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: avisopago.php?status=success");
exit();
?>