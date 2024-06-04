<?php
include'connect.php';
$id=$_GET['id'];

// Primero, obtén la licencia asociada con la colisión
$query = $db->prepare("SELECT licencias FROM colisiones WHERE id= :post_id");
$query->bindParam(':post_id', $id);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$licencia = $row['licencias'];

// Luego, obtén las rutas de las fotos asociadas con esa licencia
$result = $db->prepare("SELECT foto FROM fotos_cars WHERE licencias_colisiones= :licencia");
$result->bindParam(':licencia', $licencia);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Añade el nombre de la carpeta a la ruta de la foto
    $ruta_foto = 'files_cars/' . $row['foto'];
    
    // Intenta eliminar cada foto del disco
    if(!unlink($ruta_foto)){
        echo 'Error al eliminar la foto ' . $ruta_foto . ', por favor intente de nuevo';
        exit;
    }
}

// Luego, elimina las fotos de la base de datos
$result = $db->prepare("DELETE FROM fotos_cars WHERE licencias_colisiones= :licencia");
$result->bindParam(':licencia', $licencia);
if(!$result->execute()){    
    echo 'Error al eliminar las fotos de la base de datos, por favor intente de nuevo';
    exit;
}

// Finalmente, elimina la colisión
$result = $db->prepare("DELETE FROM colisiones WHERE id= :post_id");
$result->bindParam(':post_id', $id);
if($result->execute()){    
    header("location:vistacolisiones.php");
}else{
    echo 'Error al eliminar la colisión, por favor intente de nuevo';
}     
?>