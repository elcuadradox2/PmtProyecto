<?php
include('configbd.php');

$no_boleta = $_POST['no_boleta'];
$ubicacion_remocion = $_POST['ubicacion_remocion'];
$fecha_hora_remocion = $_POST['fecha_hora_remocion'];
$nombre_persona_comercio = $_POST['nombre_persona_comercio'];
$descripcion_consignacion = $_POST['descripcion_consignacion'];
$tipo_boleta = $_POST['tipo_boleta'];
$nombre_chapa_agente = $_POST['nombre_chapa_agente'];
$estado_pago = $_POST['estado_pago'];

// Verificando si existe el directorio
$dirLocal = "files_boletaremociones";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir = opendir($dirLocal); // Abro el directorio

if (isset($_POST['submit']) && count($_FILES['fotos_remociones']['name']) > 0) {
    // Validar que no se suban más de 10 fotos
    if (count($_FILES['fotos_remociones']['name']) > 10) {
        echo '<script>alert("No se pueden subir más de 10 fotos."); window.location.href = "remociones.php";</script>';
        exit;
    }

    // Recorrer cada archivo subido
    foreach ($_FILES['fotos_remociones']['name'] as $i => $name) {
        // strlen método de php pues devuelve la longitud de una cadena
        if (strlen($_FILES['fotos_remociones']['name'][$i]) > 1) {
            $fileName = $_FILES['fotos_remociones']['name'][$i];
            $sourceFoto = $_FILES['fotos_remociones']['tmp_name'][$i];
            $tamanoFoto = $_FILES["fotos_remociones"]['size'][$i];
            $restricciontamano = "500"; // MB
            if ((($tamanoFoto / 1024) / 1024) <= $restricciontamano) {
                // Renombrando cada foto que llega desde el formulario
                $nuevoNombreFile = substr(md5(uniqid(rand())), 0, 15);
                $extension_foto = pathinfo($fileName, PATHINFO_EXTENSION);
                $nombreFoto = $nuevoNombreFile . '.' . $extension_foto;

                $resultadoFotos = $dirLocal . '/' . $nombreFoto;

                // Mover archivo a una ubicación permanente
                move_uploaded_file($sourceFoto, $resultadoFotos);

                // Insertar información del archivo en la base de datos
                $sql = "INSERT INTO fotos_remociones (foto, ubicaciones_remociones, fecha_remocion) VALUES ('{$nombreFoto}', '{$ubicacion_remocion}', '{$fecha_hora_remocion}')";
                mysqli_query($conn, $sql);
            } else {
                echo '<p style="color:red">Existe una foto que supera el peso máximo de ' . $tamanoFoto . '</p>';
            }
        }
    }
    $sql = "INSERT INTO remociones (no_boleta, ubicacion_remocion, fecha_hora_remocion, nombre_persona_comercio, descripcion_consignacion, tipo_boleta, nombre_chapa_agente, estado_pago) VALUES ('{$no_boleta}', '{$ubicacion_remocion}', '{$fecha_hora_remocion}', '{$nombre_persona_comercio}', '{$descripcion_consignacion}', '{$tipo_boleta}' , '{$nombre_chapa_agente}', '{$estado_pago}')";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: remociones.php");
?>