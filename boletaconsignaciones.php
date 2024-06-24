<?php
include('configbd.php');

$fecha_hora = $_POST['fecha_hora'];
$ubicacion_consignacion = $_POST['ubicacion_consignacion'];
$no_licencia = $_POST['no_licencia'];
$no_tarjeta_circulacion = $_POST['no_tarjeta_circulacion'];
$no_peritaje = $_POST['no_peritaje'];
$observaciones = $_POST['observaciones'];
$nombre_chapa_agente = $_POST['nombre_chapa_agente'];
$estado_pago = $_POST['estado_pago'];

//Verificando si existe el directorio
$dirLocal = "files_boletaconsignaciones";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir         = opendir($dirLocal); //Habro el directorio


if(isset($_POST['submit']) && count($_FILES['fotos_reporte_consignacion']['name'])>0){

// Recorrer cada archivo subido

foreach ($_FILES['fotos_reporte_consignacion']['name'] as $i => $name) {
 
  //strlen método de php pues devuelve la longitud de una cadena
  if (strlen($_FILES['fotos_reporte_consignacion']['name'][$i]) > 1) {
  
  $fileName          = $_FILES['fotos_reporte_consignacion']['name'][$i];
  $sourceFoto        = $_FILES['fotos_reporte_consignacion']['tmp_name'][$i];
  $tamanoFoto        = $_FILES["fotos_reporte_consignacion"]['size'][$i];
  $restricciontamano = "500";//MB
  if((($tamanoFoto/1024)/1024)<=$restricciontamano){

  /**Renombrando cada foto que llega desde el formulario */
  $nuevoNombreFile    = substr(md5(uniqid(rand())),0,15);
  $extension_foto     = pathinfo($fileName, PATHINFO_EXTENSION);
  $nombreFoto         = $nuevoNombreFile.'.'.$extension_foto;


  $resultadoFotos     = $dirLocal.'/'.$nombreFoto;

    // Mover archivo a una ubicación permanente
    move_uploaded_file($sourceFoto, $resultadoFotos);
  
    // Insertar información del archivo en la base de datos
    $sql = "INSERT INTO fotos_consignaciones (foto, ubicacion_consignaciones, fecha_consignacion) VALUES ('{$nombreFoto}', '{$ubicacion_consignacion}', '{$fecha_hora}')";
mysqli_query($conn, $sql);

    
  }else{
    echo'<p style="color:red">Existe una foto que supera el peso Maximo de '.$tamanoFoto.'</p>';
  }
}
}
$sql = "INSERT INTO consignaciones (fecha_hora, ubicacion_consignacion, no_licencia, no_tarjeta_circulacion, no_peritaje, observaciones, nombre_chapa_agente, estado_pago) VALUES ('{$fecha_hora}', '{$ubicacion_consignacion}', '{$no_licencia}', '{$no_tarjeta_circulacion}', '{$no_peritaje}', '{$observaciones}', '{$nombre_chapa_agente}', '{$estado_pago}')";
mysqli_query($conn, $sql);
} 

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: consignaciones.php");

?>
