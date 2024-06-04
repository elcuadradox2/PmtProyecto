<?php
include('configbd.php');

$fecha_hora = $_POST['fecha_hora'];
$nombre_agente = $_POST['nombre_agente'];

//Verificando si existe el directorio
$dirLocal = "files_boletaentrevista";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir         = opendir($dirLocal); //Habro el directorio


if(isset($_POST['submit']) && count($_FILES['fotos_entrevista']['name'])>0){

// Recorrer cada archivo subido

foreach ($_FILES['fotos_entrevista']['name'] as $i => $name) {
 
  //strlen método de php pues devuelve la longitud de una cadena
  if (strlen($_FILES['fotos_entrevista']['name'][$i]) > 1) {
  
  $fileName          = $_FILES['fotos_entrevista']['name'][$i];
  $sourceFoto        = $_FILES['fotos_entrevista']['tmp_name'][$i];
  $tamanoFoto        = $_FILES["fotos_entrevista"]['size'][$i];
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
    $sql = "INSERT INTO fotos_entrevista (foto, fecha_entrevista) VALUES ('{$nombreFoto}', '{$fecha_hora}')";
mysqli_query($conn, $sql);

    
  }else{
    echo'<p style="color:red">Existe una foto que supera el peso Maximo de '.$tamanoFoto.'</p>';
  }
}
}
$sql = "INSERT INTO entrevista (fecha_hora, nombre_agente) VALUES ('{$fecha_hora}', '{$nombre_agente}')";
    mysqli_query($conn, $sql);
} 

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: bitacoraoperativos.php");

?>