<?php
include'connect.php';
$id=$_GET['id'];

// Primero, obtén la ubicacion asociada con la administrativa
$query = $db->prepare("SELECT fecha_hora, nombre_propietario FROM multas_administrativas WHERE id= :post_id");
$query->bindParam(':post_id', $id);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$fecha_hora = $row['fecha_hora'];
$nombre_propietario = $row['nombre_propietario'];


// Luego, obtén las rutas de las fotos asociadas con esa ubicacion y el mismo id
$result = $db->prepare("SELECT foto FROM fotos_administrativas WHERE fecha_administrativa= :fecha_hora AND nombre_propietarios= :nombre_propietario");
$result->bindParam(':fecha_hora', $fecha_hora);
$result->bindParam(':nombre_propietario', $nombre_propietario);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Añade el nombre de la carpeta a la ruta de la foto
    $ruta_foto = 'files_boletaadministrativas/' . $row['foto'];
    
    // Intenta eliminar cada foto del disco
    if(!unlink($ruta_foto)){
        echo 'Error al eliminar la foto ' . $ruta_foto . ', por favor intente de nuevo';
        exit;
    }
}

// Luego, elimina las fotos de la base de datos que corresponden al mismo id y administrativa
$result = $db->prepare("DELETE FROM fotos_administrativas WHERE fecha_administrativa= :fecha_hora AND nombre_propietarios= :nombre_propietario");
$result->bindParam(':fecha_hora', $fecha_hora);
$result->bindParam(':nombre_propietario', $nombre_propietario);
if(!$result->execute()){    
    echo 'Error al eliminar las fotos de la base de datos, por favor intente de nuevo';
    exit;
}

// Finalmente, elimina la colisión
$result = $db->prepare("DELETE FROM multas_administrativas WHERE id= :post_id");
$result->bindParam(':post_id', $id);
if($result->execute()){    
    header("location:vistaadministrativas.php");
}else{
    echo 'Error al eliminar la boleta, por favor intente de nuevo';
}     
?>