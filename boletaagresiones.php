<?php
include('configbd.php');

$no_boleta = $_POST['no_boleta'];
$nombre_chapa = $_POST['nombre_chapa'];
$lugar = $_POST['lugar'];
$fecha_hora = $_POST['fecha_hora'];
$nombre = $_POST['nombre'];
$no_licencia = $_POST['no_licencia'];
$no_placa = $_POST['no_placa'];
$tipo_boleta = $_POST['tipo_boleta'];
$nombre_chapa_agente = $_POST['nombre_chapa_agente'];
$estado_pago = $_POST['estado_pago'];

// Verificando si existe el directorio
$dirLocal = "files_boletaagresiones";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir = opendir($dirLocal); // Abro el directorio

if (isset($_POST['submit']) && count($_FILES['fotos_agresiones']['name']) > 0) {
    // Verificar que no se suban más de 10 fotos
    if (count($_FILES['fotos_agresiones']['name']) > 10) {
        header("Location: agresiones.php?status=error&message=too_many_files");
        exit();
    }

    // Recorrer cada archivo subido
    foreach ($_FILES['fotos_agresiones']['name'] as $i => $name) {
        // strlen método de php pues devuelve la longitud de una cadena
        if (strlen($_FILES['fotos_agresiones']['name'][$i]) > 1) {
            $fileName = $_FILES['fotos_agresiones']['name'][$i];
            $sourceFoto = $_FILES['fotos_agresiones']['tmp_name'][$i];
            $tamanoFoto = $_FILES["fotos_agresiones"]['size'][$i];
            $restricciontamano = 10; // MB
            if ((($tamanoFoto / 1024) / 1024) <= $restricciontamano) {
                // Renombrando cada foto que llega desde el formulario
                $nuevoNombreFile = substr(md5(uniqid(rand())), 0, 15);
                $extension_foto = pathinfo($fileName, PATHINFO_EXTENSION);
                $nombreFoto = $nuevoNombreFile . '.' . $extension_foto;

                $resultadoFotos = $dirLocal . '/' . $nombreFoto;

                // Mover archivo a una ubicación permanente
                move_uploaded_file($sourceFoto, $resultadoFotos);

                // Insertar información del archivo en la base de datos
                $sql = "INSERT INTO fotos_agresiones (foto, licencia_agresiones, fecha_agresion) VALUES ('{$nombreFoto}', '{$no_licencia}', '{$fecha_hora}')";
                mysqli_query($conn, $sql);
            } else {
                echo '<p style="color:red">Existe una foto que supera el peso Maximo de ' . $tamanoFoto . '</p>';
            }
        }
    }

    $sql = "INSERT INTO agresiones (no_boleta, nombre_chapa, lugar, fecha_hora, nombre, no_licencia, no_placa, tipo_boleta, nombre_chapa_agente, estado_pago) VALUES ('{$no_boleta}', '{$nombre_chapa}', '{$lugar}', '{$fecha_hora}', '{$nombre}', '{$no_licencia}', '{$no_placa}', '{$tipo_boleta}', '{$nombre_chapa_agente}', '{$estado_pago}')";
    if (mysqli_query($conn, $sql)) {
        // Redirigir con éxito
        header("Location: agresiones.php?status=success");
    } else {
        // Redirigir con error
        header("Location: agresiones.php?status=error");
    }
} else {
    // Redirigir con error si no se subieron fotos
    header("Location: agresiones.php?status=error");
}

mysqli_close($conn);
?>