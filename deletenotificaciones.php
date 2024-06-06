<?php
include'connect.php';
$id=$_GET['id'];

// Primero, obtén la ubicacion asociada con la consignacion
$query = $db->prepare("SELECT ubicacion_notificacion, fecha_hora_notificacion FROM notificaciones WHERE id= :post_id");
$query->bindParam(':post_id', $id);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$ubicacion_notificacion = $row['ubicacion_notificacion'];
$fecha_hora_notificacion = $row['fecha_hora_notificacion'];

// Luego, obtén las rutas de las fotos asociadas con esa ubicacion y el mismo id
$result = $db->prepare("SELECT foto FROM fotos_notificaciones WHERE ubicaciones_notificaciones= :ubicacion_notificacion AND fecha_notificacion= :fecha_hora_notificacion");
$result->bindParam(':ubicacion_notificacion', $ubicacion_notificacion);
$result->bindParam(':fecha_hora_notificacion', $fecha_hora_notificacion);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Añade el nombre de la carpeta a la ruta de la foto
    $ruta_foto = 'files_boletanotificaciones/' . $row['foto'];
    
    // Intenta eliminar cada foto del disco
    if(!unlink($ruta_foto)){
        echo 'Error al eliminar la foto ' . $ruta_foto . ', por favor intente de nuevo';
        exit;
    }
}

// Luego, elimina las fotos de la base de datos que corresponden al mismo id y placa_peritaje_transportes
$result = $db->prepare("DELETE FROM fotos_notificaciones WHERE ubicaciones_notificaciones= :ubicacion_notificacion AND fecha_notificacion= :fecha_hora_notificacion");
$result->bindParam(':ubicacion_notificacion', $ubicacion_notificacion);
$result->bindParam(':fecha_hora_notificacion', $fecha_hora_notificacion);
if(!$result->execute()){    
    echo 'Error al eliminar las fotos de la base de datos, por favor intente de nuevo';
    exit;
}

// Finalmente, elimina la colisión
$result = $db->prepare("DELETE FROM notificaciones WHERE id= :post_id");
$result->bindParam(':post_id', $id);
if($result->execute()){    
    header("location:vistanotificaciones.php");
}else{
    echo 'Error al eliminar la boleta, por favor intente de nuevo';
}     
?>