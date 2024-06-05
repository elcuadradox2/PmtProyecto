<?php
include('configbd.php');

$fecha_hora = $_POST['fecha_hora'];
$nombre_agente = $_POST['nombre_agente'];

//Verificando si existe el directorio
$dirLocal = "files_boletareporteinterno";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir         = opendir($dirLocal); //Habro el directorio


if(isset($_POST['submit']) && count($_FILES['fotos_reporte']['name'])>0){

// Recorrer cada archivo subido

foreach ($_FILES['fotos_reporte']['name'] as $i => $name) {
 
  //strlen método de php pues devuelve la longitud de una cadena
  if (strlen($_FILES['fotos_reporte']['name'][$i]) > 1) {
  
  $fileName          = $_FILES['fotos_reporte']['name'][$i];
  $sourceFoto        = $_FILES['fotos_reporte']['tmp_name'][$i];
  $tamanoFoto        = $_FILES["fotos_reporte"]['size'][$i];
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
    $sql = "INSERT INTO fotos_reporte (foto, fecha_reporte) VALUES ('{$nombreFoto}', '{$fecha_hora}')";
    mysqli_query($conn, $sql);

    
  }else{
    echo'<p style="color:red">Existe una foto que supera el peso Maximo de '.$tamanoFoto.'</p>';
  }
}
}
$sql = "INSERT INTO reporte_interno (fecha_hora, nombre_agente) VALUES ('{$fecha_hora}', '{$nombre_agente}')";
    mysqli_query($conn, $sql);
} 

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: reporteinterno.php");

?>