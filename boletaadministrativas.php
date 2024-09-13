<?php
include('configbd.php');

$fecha_hora = $_POST['fecha_hora'];
$no_taxi = $_POST['no_taxi'];
$nombre_propietario = $_POST['nombre_propietario'];
$nombre_piloto = $_POST['nombre_piloto'];
$no_dpi = $_POST['no_dpi'];
$no_placas = $_POST['no_placas'];
$nombre_agente = $_POST['nombre_agente'];
$estado_pago = $_POST['estado_pago'];

// Verificando si existe el directorio
$dirLocal = "files_boletaadministrativas";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir = opendir($dirLocal); // Abro el directorio

if (isset($_POST['submit']) && count($_FILES['fotos_administrativas']['name']) > 0) {
    // Validar que no se suban más de 10 fotos
    if (count($_FILES['fotos_administrativas']['name']) > 10) {
        // Redirigir con mensaje de error
        header("Location: multasadministrativas.php?status=error&message=too_many_files");
        exit();
    }

    // Recorrer cada archivo subido
    foreach ($_FILES['fotos_administrativas']['name'] as $i => $name) {
        // strlen método de php pues devuelve la longitud de una cadena
        if (strlen($_FILES['fotos_administrativas']['name'][$i]) > 1) {
            $fileName = $_FILES['fotos_administrativas']['name'][$i];
            $sourceFoto = $_FILES['fotos_administrativas']['tmp_name'][$i];
            $tamanoFoto = $_FILES["fotos_administrativas"]['size'][$i];
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
                $sql = "INSERT INTO fotos_administrativas (foto, fecha_administrativa, nombre_propietarios) VALUES ('{$nombreFoto}', '{$fecha_hora}', '{$nombre_propietario}')";
                mysqli_query($conn, $sql);
            } else {
                echo '<p style="color:red">Existe una foto que supera el peso máximo de ' . $tamanoFoto . '</p>';
            }
        }
    }
    $sql = "INSERT INTO multas_administrativas (fecha_hora, no_taxi, nombre_propietario, nombre_piloto, no_dpi, no_placas, nombre_agente, estado_pago) VALUES ('{$fecha_hora}', '{$no_taxi}', '{$nombre_propietario}', '{$nombre_piloto}', '{$no_dpi}', '{$no_placas}', '{$nombre_agente}', '{$estado_pago}')";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: multasadministrativas.php?status=success");
exit();
?>