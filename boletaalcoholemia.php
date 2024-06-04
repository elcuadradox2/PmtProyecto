<?php
include('configbd.php');

$fecha_hora = $_POST['fecha_hora'];
$lugar_prueba = $_POST['lugar_prueba'];
$nombre_conductor = $_POST['nombre_conductor'];
$domicilio_conductor = $_POST['domicilio_conductor'];
$no_licencia = $_POST['no_licencia'];
$tarjeta_circulacion = $_POST['tarjeta_circulacion'];
$no_placas = $_POST['no_placas'];
$tipo_boleta = $_POST['tipo_boleta'];
$nombre_chapa_agente = $_POST['nombre_chapa_agente'];


//Verificando si existe el directorio
$dirLocal = "files_boletaalcoholemia";
if (!file_exists($dirLocal)) {
    mkdir($dirLocal, 0777, true);
}
$miDir         = opendir($dirLocal); //Habro el directorio


if(isset($_POST['submit']) && count($_FILES['fotos_alcoholemia']['name'])>0){

// Recorrer cada archivo subido

foreach ($_FILES['fotos_alcoholemia']['name'] as $i => $name) {
 
  //strlen método de php pues devuelve la longitud de una cadena
  if (strlen($_FILES['fotos_alcoholemia']['name'][$i]) > 1) {
  
  $fileName          = $_FILES['fotos_alcoholemia']['name'][$i];
  $sourceFoto        = $_FILES['fotos_alcoholemia']['tmp_name'][$i];
  $tamanoFoto        = $_FILES["fotos_alcoholemia"]['size'][$i];
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
    $sql = "INSERT INTO fotos_alcoholemia (foto, licencias_alcoholemia) VALUES ('{$nombreFoto}', '{$no_licencia}')";
mysqli_query($conn, $sql);

    
  }else{
    echo'<p style="color:red">Existe una foto que supera el peso Maximo de '.$tamanoFoto.'</p>';
  }
}
}
$sql = "INSERT INTO alcoholemia (fecha_hora, lugar_prueba, nombre_conductor, domicilio_conductor, no_licencia, tarjeta_circulacion, no_placas, tipo_boleta, nombre_chapa_agente) VALUES ('{$fecha_hora}', '{$lugar_prueba}', '{$nombre_conductor}', '{$domicilio_conductor}', '{$no_licencia}' , '{$tarjeta_circulacion}' , '{$no_placas}' , '{$tipo_boleta}' , '{$nombre_chapa_agente}')";
mysqli_query($conn, $sql);
} 

mysqli_close($conn);
// Redirigir a la página de inicio
header("Location: alcoholemia.php");

?>

