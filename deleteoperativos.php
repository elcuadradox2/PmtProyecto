<?php
include'connect.php';
$id=$_GET['id'];

// Primero, obtén la ubicacion asociada con la consignacion
$query = $db->prepare("SELECT fecha_hora FROM bitacora_operativos WHERE id= :post_id");
$query->bindParam(':post_id', $id);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$fecha_hora = $row['fecha_hora'];

// Luego, obtén las rutas de las fotos asociadas con esa ubicacion
$result = $db->prepare("SELECT foto FROM fotos_operativos WHERE fecha_operativos= :fecha_hora");
$result->bindParam(':fecha_hora', $fecha_hora);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Añade el nombre de la carpeta a la ruta de la foto
    $ruta_foto = 'files_bitacoraoperativos/' . $row['foto'];
    
    // Intenta eliminar cada foto del disco
    if(!unlink($ruta_foto)){
        echo 'Error al eliminar la foto ' . $ruta_foto . ', por favor intente de nuevo';
        exit;
    }
}

// Luego, elimina las fotos de la base de datos
$result = $db->prepare("DELETE FROM fotos_operativos WHERE fecha_operativos= :fecha_hora");
$result->bindParam(':fecha_hora', $fecha_hora);
if(!$result->execute()){    
    echo 'Error al eliminar las fotos de la base de datos, por favor intente de nuevo';
    exit;
}

// Finalmente, elimina la colisión
$result = $db->prepare("DELETE FROM bitacora_operativos WHERE id= :post_id");
$result->bindParam(':post_id', $id);
if($result->execute()){    
    header("location:vistaoperativos.php");
}else{
    echo 'Error al eliminar la boleta, por favor intente de nuevo';
}     
?>